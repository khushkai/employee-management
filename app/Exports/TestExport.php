<?php

namespace App\Exports;

use App\Models\Test;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return Test::select('id','name','age')->get();   
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Age'];
    }
}
