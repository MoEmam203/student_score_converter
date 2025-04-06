<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentScoreImport implements ToCollection, WithHeadingRow
{
    public Collection $scores;

    public function collection(Collection $collection)
    {
        $this->scores = $collection->sortBy('student_id')->groupBy(['student_id', 'subject']);
    }
}
