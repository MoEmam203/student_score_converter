<?php

namespace App\Http\Controllers;

use App\Imports\StudentScoreImport;
use App\Services\StudentScoreService;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class StudentScoreConverterController extends Controller
{
    public function __construct(public readonly StudentScoreService $studentScoreService) {}

    public function index(): JsonResponse
    {
        try {
            // Check if the file exists
            if (! file_exists(public_path('storage/scores (1).csv'))) {
                return response()->json([
                    'error' => 'File not found.',
                ], 404);
            }

            // Import the CSV file data
            $import = new StudentScoreImport;
            Excel::import($import, 'scores (1).csv', 'public');
            $scores = $import->scores;

            $transformedScores = $this->studentScoreService->transformScores(scores: $scores);

            // Return the transformed data
            return response()->json([
                'data' => $transformedScores,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while processing the file.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
