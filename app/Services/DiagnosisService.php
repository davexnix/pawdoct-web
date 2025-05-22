<?php

namespace App\Services;

use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiagnosisService
{
    public const FEATURES = [
        "anorexia",
        "muntah",
        "lemah",
        "kurang respon",
        "dehidrasi",
        "demam",
        "diare",
        "hipersevalis",
        "radang telinga",
        "batuk",
        "hidung meler",
        "gatal",
        "telinga keropeng",
        "pilek",
        "bersin2",
        "mata berair",
    ];

    public static function check(Request $request, array $data)
    {
        try {
            $client = Http::baseUrl(env('PAWDOCT_ML_SERVICE_URL', 'http://localhost:5000'));
            $result = $client->post('/predict', $data);

            $result->throwIfClientError();
            $result->throwIfServerError();

            $json = $result->json();
            $result->close();

            Log::debug('diagnosis', ['params' => $data, 'result' => $json]);

            $diagnosis = new Diagnosis([
                'user_id' => $request->user()->id,
                'pet_name' => $request->pet_name,
                'pet_gender' => $request->pet_gender,
                'results' => $json,
            ]);

            return [
                'success' => true,
                'message' => 'The diagnostic results are available.',
                'results' => $diagnosis->refresh()->toArray(),
            ];
        } catch (\Throwable $th) {
            Log::emergency('Failed to get diagnostics prediction', [
                'error' => $th->getMessage(),
                'file' => $th->getFile(),
                'env' => [
                    'PAWDOCT_ML_SERVICE_URL' => env('PAWDOCT_ML_SERVICE_URL')
                ]
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get diagnostic data.',
                'results' => [],
            ];
        }
    }
}
