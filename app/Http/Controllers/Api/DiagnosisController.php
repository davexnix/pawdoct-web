<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Services\DiagnosisService;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    private readonly array $features;

    public function __construct()
    {
        $this->features = DiagnosisService::FEATURES;
    }

    public function list(Request $request)
    {
        $diagnosis = Diagnosis::where('user_id', $request->user()->id)->get();

        return response()->json($diagnosis);
    }

    public function check(Request $request)
    {
        $rules = [
            'pet_name' => 'required|string|max:225',
            'pet_gender' => 'required|in:jantan,betina'
        ];

        foreach ($this->features as $feature) {
            $rules[$feature] = "in:Yes,No";
        }

        $data = $request->validate($rules);

        $params = [];
        foreach ($this->features as $feature) {
            if (array_key_exists($feature, $data)) {
                $params[$feature] = $data[$feature];
            } else {
                $params[$feature] = "No";
            }
        }

        $result = DiagnosisService::check($request, $params);

        if ($result['success']) {
            return response()->json($result);
        }

        return response()->json($result, 500);
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'diagnosis' => 'required'
        ]);

        // Log::debug("Saving diagnosis", $data);

        $diagnosis = new Diagnosis($data['diagnosis']);
        if ($diagnosis->save()) {
            // Log::debug("Saving diagnosis success");
            return response()->json($diagnosis->toArray(), 201);
        }

        // Log::debug("Saving diagnosis failed");

        return response()->json(['message' => 'Failed to save data'], 500);
    }

    public function delete(Request $request, int $id)
    {
        $diagnosis = Diagnosis::find($id)->first();
        if (!$diagnosis) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        if ($diagnosis->delete()) {
            return response()->noContent();
        }

        return response()->json(['message' => 'Failed to delete data'], 500);
    }

    public function getFeatures()
    {
        return response()->json($this->features);
    }
}
