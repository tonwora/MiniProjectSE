<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use App\Imports\TAImport;
use Maatwebsite\Excel\Facades\Excel; 
 
use App\Models\Student;
 
class ExcelCSVController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
       return view('excel-csv-import');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcelCSV(Request $request) 
    {
        $validatedData = $request->validate([
 
           'file' => 'required',
 
        ]);
 
        Excel::import(new StudentImport,$request->file('file'));
 
        return redirect()->back();
    }
 
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportExcelCSV($slug) 
    {
        return Excel::download(new StudentExport, 'Student.'.$slug);
    }
    
    public function importExcelCSVTA(Request $request) 
    {
        $validatedData = $request->validate([
 
           'file' => 'required',
 
        ]);
 
        Excel::import(new TAImport,$request->file('file'));
 
        return redirect()->back();
    }
}