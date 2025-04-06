<?php

namespace App\Services;

use Illuminate\Support\Collection;

class StudentScoreService
{
    public function transformScores($scores)
    {
        // Transform the scores into the desired structure
        return $scores->map(function ($studentScores, $studentId) {
            $firstRecord = $studentScores->first();

            return [
                'student_id' => (int) $studentId,
                'name' => $firstRecord['name'] ?? 'No Name',
                'subject' => $firstRecord['subject'] ?? 'No Subject',
                'scores' => $this->sortScores($studentScores->toArray(), $firstRecord['subject'] ?? 'No Subject'),
            ];
        })->values()->toArray();
    }

    private function sortScores(array $scores, string $subject): Collection
    {
        usort($scores, function ($a, $b) use ($subject) {
            $valueA = $this->normalizeScoreToNumber($a['score'], $subject);
            $valueB = $this->normalizeScoreToNumber($b['score'], $subject);

            // Sort descending (highest first)
            return $valueB <=> $valueA;
        });

        return collect($scores)->map(function ($score) {
            return [
                'learning_objective' => $score['learning_objective'],
                'score' => $score['score'],
            ];
        })->values();
    }

    private function normalizeScoreToNumber($score, $subject)
    {
        return match ($subject) {
            'English' => (int) $score,
            'Maths' => $this->convertLetterGradeToScore($score),
            'Science' => $this->convertDescriptiveRatingToScore($score),
            default => 0 // Default to 0 if not found
        };

    }

    private function convertLetterGradeToScore($grade)
    {
        $grades = [
            'A' => 6,
            'B' => 5,
            'C' => 4,
            'D' => 3,
            'E' => 2,
            'F' => 1,
        ];

        return $grades[$grade] ?? 0;
    }

    private function convertDescriptiveRatingToScore($rating)
    {
        $ratings = [
            'Excellent' => 5,
            'Good' => 4,
            'Average' => 3,
            'Poor' => 2,
            'Very Poor' => 1,
        ];

        return $ratings[$rating] ?? 0;
    }
}
