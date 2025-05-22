<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Services\DiagnosisService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiagnosaController extends Controller
{
    private readonly array $features;

    public function __construct()
    {
        $this->features = DiagnosisService::FEATURES;
    }

    public function index()
    {
        return view('diagnosa', [
            'features' => $this->features,
        ]);
    }

    public function diagnosa(Request $request)
    {
        $rules = [
            'pet_name' => 'required|string|max:225',
            'pet_gender' => 'required|in:jantan,betina',
            'features' => 'required|array'
        ];

        $request->validate($rules);

        $params = [];
        foreach ($this->features as $feature) {
            if (in_array($feature, $request->features)) {
                $params[$feature] = "Yes";
            } else {
                $params[$feature] = "No";
            }
        }

        // Cek minimal 1 gejala dipilih
        $cek = collect($params)->filter(function ($i) {
            return $i == "Yes";
        });

        if ($cek->isEmpty()) {
            return back()->withInput()->withErrors([
                'features' => 'Minimal 1 gejala harus dipilih'
            ]);
        }

        $result = DiagnosisService::check($request, $params);

        if ($result['success']) {
            $diagnosis = new Diagnosis($result['results']);
            if ($diagnosis->save()) {
                return redirect()->route('diagnosa.result', ['id' => $diagnosis->id])->with(
                    'diagnosa',
                    'Berhasil mendapatkan hasil diagnosa!'
                );
            }

            $result['message'] = 'An error ocurred while getting data';
        }

        return back()->withInput()->withErrors(['result' => $result['message']]);
    }

    public function result(Request $request, $id)
    {
        // Pastikan hanya mengambil diagnosa user yang login
        $diagnosa = Diagnosis::where(['id' => intval($id), 'user_id' => $request->user()->id])->firstOrFail();

        $gejalaDipilih = collect($diagnosa->results['features_used'])->filter(function ($g) {
            return $g === 1;
        })->toArray();

        $probabilities = $diagnosa->results['probabilities'];

        // Hitung total semua probabilitas
        $total = array_sum($probabilities);

        // Hitung persentase tiap penyakit
        $percentages = [];

        foreach ($probabilities as $disease => $value) {
            $percentages[$disease] = $total > 0 ? round(($value / $total) * 100, 2) : 0;
        }

        return view('hasil-diagnosa', [
            'id' => $diagnosa->id,
            'prediksi' => $diagnosa->results['prediction'],
            'gejalaDipilih' => $gejalaDipilih,
            'percentages' => $percentages,
            'suggestions' => $diagnosa->results['suggestions'],
        ]);
    }

    public function riwayat(Request $request)
    {
        $diagnosa = Diagnosis::where('user_id', $request->user()->id)->get();

        $diagnosa = collect($diagnosa)->map(function ($row) {
            $probabilities = $row->results['probabilities'];
            $total = array_sum($probabilities);

            $percentages = [];
            foreach ($probabilities as $disease => $value) {
                $percentages[$disease] = $total > 0 ? round(($value / $total) * 100, 2) : 0;
            }

            $row->prediksi = Str::title($row->results['prediction']) . ' (' . $percentages[$row->results['prediction']] . '%)';
            return $row;
        });

        return view('riwayat-diagnosa', [
            'diagnosa' => $diagnosa
        ]);
    }

    public function delete(Request $request, $id)
    {
        $diagnosa = Diagnosis::where(['id' => intval($id), 'user_id' => $request->user()->id])->firstOrFail();
        $diagnosa->delete();

        return redirect()->route('riwayat-diagnosa')->with('diagnosa', 'Riwayat diagnosa berhasil dihapus!');
    }
}
