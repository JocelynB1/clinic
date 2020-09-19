<?php
namespace App\Exports;

use App\Patient;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Excel;

class PatientFolderExport implements FromView
{
    use Exportable;
    private $patient;
  public function __construct($id)
  {
      $this->patient=Patient::find($id);
      libxml_use_internal_errors(true);

  }
  
    public function view():View{
        return view('patients.allpdf',[
            'patient'=>$this->patient,
            'record'=>$this->patient
        ]);
    }
}

