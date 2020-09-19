<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use App\Helpers\PaginatedTableHelper;
use App\Helpers\ArrayPresentationHelper;
use Session;
use App\Http\Requests\PatientRequest;
use App\PatientVital;
use App\Vital;
use App\LabPatient;
use App\Lab;
use App\Visit;
use App\PatientVisit;
use App\Consultation;
use App\ConsultationPatient;
use App\Exports\PatientFolderExport;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('name')) {
            $records = Patient::Where("name","LIKE",'%' . request('name'). '%')->paginate(25);
            $record = new Patient;
            $preskeys = new ArrayPresentationHelper($record);
            $keys = $preskeys->getSortedKeys();
            return view('patients.index')->with([
                'records' => $records,
                'keys' => $keys
            ]);
        }else{
        $phelper = new PaginatedTableHelper();
        $record = new Patient;
        $records = $phelper->buildPaginatedTable($record, 'id');
         $preskeys = new ArrayPresentationHelper($record);
        $keys = $preskeys->getSortedKeys();

        return view('patients.index')->with([
            'records' => $records,
            'keys' => $keys
        ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    public function createPrevious()
    {
        return view('patients.createPrevious');
    }
    public function searchByName()
    {
        return view('patients.searchByName');
    }
    public function searchByPhoneNumber()
    {
        return view('patients.searchByPhoneNumber');
    }
    public function showPatientVitals($id)
    {
        $patient = Patient::find($id);
        $vitals = null;
        if (request()->has('vital_id')) {
            $vitals = Vital::find(request('vital_id'));
        }

        $patientVitals = PatientVital::where("patient_id", $patient->id)->paginate(25);
       
        return view("patients.__show_patient_vitals")->with([
            "name" => $patient->name,
            "records" => $patientVitals, "vitals" => $vitals,'id'=>$id
        ]);
    }
    public function showPatientLabs($id)
    {
        $patient = Patient::find($id);
        $labs = null;
        
        if (request()->has('lab_id')) {
            $labs = Lab::find(request('lab_id'));
        }

        $labPatients = LabPatient::where("patient_id", $patient->id)->paginate(25);
       
        return view("patients.__show_lab_patients")->with([
            "name" => $patient->name,
            "records" => $labPatients, "labs" => $labs,'id'=>$id
        ]);
    }
    public function showPatientVisits($id)
    {
        $patient = Patient::find($id);
        $visits = null;
    
        if (request()->has('visit_id')) {
            $visits = Visit::find(request('visit_id'));
        }

        $patientVisits = PatientVisit::where("patient_id", $patient->id)->paginate(25);
       
        return view("patients.__show_patient_visits")->with([
            "name" => $patient->name,
            "records" => $patientVisits, "visits" => $visits,'id'=>$id
        ]);
    }
    public function showPatientConsultations($id)
    {
        $patient = Patient::find($id);
        $consultations = null;
    
        if (request()->has('consultation_id')) {
            $consultations = Consultation::find(request('consultation_id'));
        }

        $consultationPatients = ConsultationPatient::where("patient_id", $patient->id)->paginate(25);
       
        return view("patients.__show_consultation_patients")->with([
            "name" => $patient->name,
            "records" => $consultationPatients, "consultations" => $consultations,'id'=>$id
        ]);
    }
    public function search(Request $request)
    {
        if (isset($request->pid)) {
            $pid = $request->pid;
            if ($pid != "") {
                $record = Patient::where('pid', $pid)->first();
                if ($record != null) {

                    return view('patients.createPrevious')->with(['record' => $record]);
                }
            }
        }
        if (isset($request->name)) {
            $name = $request->name;
            if ($name != "") {
                $record = Patient::where('name', $name)->paginate(25);
                if ($record->isEmpty() == false) {

                    return view('patients.searchByName')->with(['record' => $record]);
                }
            }
        }
        if (isset($request->mobile_phone_number)) {
            $phoneNum = $request->mobile_phone_number;
            if ($phoneNum != "") {
                $record = Patient::where('mobile_phone_number', $phoneNum)
                    ->orWhere('alternative_phone_number', $phoneNum)->paginate(25);

                if ($record->isEmpty() == false) {

                    return view('patients.searchByPhoneNumber')->with(['record' => $record]);
                }
            }
        }
        Session::flash('flash_message', 'No records found!');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {

        $input = $request->all();
        unset($input['_token']);
      

        $lastPatient = Patient::all()->pop();
        $id = "1";
        if ($lastPatient != null) {
            $id = (string) ($lastPatient->id + 1);
        }
        $length = strlen($id);
        for ($i = $length; $i < 5; $i++) {
            $id = "0" . $id;
        }
        $input['pid'] = "CPS" . date('y') . $id;
        $patient = new Patient($input);

        $patient->save();

        Session::flash('flash_message', 'Patient Added, Now add Medical History!');

        return redirect()->action('VisitController@create', ['patient_id' => $patient->id]);
        //return view('visits.create')->with(['patient'=>$patient]);
        // return redirect()->back();

        /*
              return view('patients.create')->with(['patient'=>$patient,
            'record' => $record,
            'keys' => $keys
        ]);
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $record = $patient;
        $preskeys = new  ArrayPresentationHelper($record);
        $keys = $preskeys->getSortedKeys();

        return view('patients.show')->with(['record' => $record, 'keys' => $keys]);
    }
    public function showAllPatientData(Patient $patient)
    {
      
        return view('patients.all')->with(['patient' => $patient,'record'=>$patient]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $record = $patient;

        return view('patients.edit')->with(['record' => $record]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function review($id)
    {


        $patient = Patient::find($id);
        $record = $patient;
        return view('patients.review')->with([
            'record' => $record,
            'patient' => $patient
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $record = $patient;
        $input = $request->all();
        $record->update($input);

        Session::flash('flash_message', 'Record successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $record = $patient;
        PatientVital::where("patient_id",$record->id)->delete();
        PatientVisit::where("patient_id",$record->id)->delete();
        LabPatient::where("patient_id",$record->id)->delete();
        ConsultationPatient::where("patient_id",$record->id)->delete();
        $record->labs()->delete();
        $record->visits()->delete();
        $record->vitals()->delete();
        $record->consultations()->delete();
        $record->delete();

        Session::flash('flash_message', 'Record successfully deleted!');

        $phelper = new PaginatedTableHelper();
        $record = new Patient;
        $records = $phelper->buildPaginatedTable($record, 'id');
        $preskeys = new ArrayPresentationHelper($record);
        $keys = $preskeys->getSortedKeys();

        return view('patients.index')->with([
            'records' => $records,
            'keys' => $keys
        ]);
    }
    public function export($id){
        
        return (new PatientFolderExport($id))->download(Patient::find($id)->name.time().'PF.XLSX',\Maatwebsite\Excel\Excel::XLSX);
    }
}
