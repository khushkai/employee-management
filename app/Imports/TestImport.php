<?php

namespace App\Imports;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ShouldQueue;

class TestImport implements ToModel, WithChunkReading, WithHeadingRow, ShouldQueue
{
    public function model(array $row)
    {
        return new Test([
            'name' => $row['name'],
            'age'  => $row['age'],
        ]);
    }

    public function chunkSize(): int
    {
        return 10; 
    }
}