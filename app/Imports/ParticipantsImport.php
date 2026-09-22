<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Participant([
            'name' => $row['name'],
            'place_of_birth' => $row['place_of_birth'],
            'date_of_birth' => isset($row['date_of_birth'])
                ? Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d')
                : null,
            'address' => $row['address'],
            'qualification' => $row['qualification'],
            'japanese_skills' => $row['japanese_skills'],
            'materials' => $row['materials'],
            'motivation' => $row['motivation'],
            'vision' => $row['vision'],
            'youtube_link' => isset($row['youtube_link'])
                ? trim(str_replace(' ', '', $row['youtube_link']))
                : null,
        ]);
    }
}
