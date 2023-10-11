<?php

namespace App\Exports;

use App\Models\TA;
use Maatwebsite\Excel\Concerns\FromCollection;

class TAExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TA::all();
    }
}
