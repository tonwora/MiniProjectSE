<?php
    
namespace App\Imports;
    
use App\Models\Student;
use App\Models\TA;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
     
class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'stdcode'     => $row['stdcode'],
            'name'    => $row['name'], 
            'email'    => $row['email'], 
            'course_id'    => $row['course_id'], 
        ]);
    }
}