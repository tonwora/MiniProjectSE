<?php

namespace App\Imports;

use App\Models\TA;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
     
class TAImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TA([
            'name'    => $row['name'], 
            'email'    => $row['email'], 
            'course_id'    => $row['course_id'], 
        ]);
    }
}
