<?php

namespace App\Http\Controllers;

use App\Consultation;
use Illuminate\Http\Request;
use App\Helpers\PaginatedTableHelper;
use App\Helpers\ArrayPresentationHelper;
use App\Patient;
use App\Vital;
use Session;
use App\PatientVital;
use App\Http\Requests\ConsultationRequest;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Helpers\FraminghamRiskScoreCalculator;
use App\ConsultationPatient;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $request=request();
        if (isset($request->id)) {
            $id = $request->id;
            if ($id != "") {
                $record = Patient::where('id', $id)->first();
                if ($record != null) {
                    $consultations=$record->consultations()->paginate(5);        
                    return view('consultations.index')->with([
                        'record' => $record,
                        'consultations'=>$consultations
                    ]);
                }
            }
        }
          $p=new PatientVital;
        $records =$p->where("has_seen_doctor?","=",false)->paginate(15);

 
        return view('consultations.index')->with(['records' => $records]);
    }
    public function epirxisk()
    {
        
        $request=request();
        if (isset($request->id)) {
            $id = $request->id;
            if ($id != "") {
                $record = Patient::where('id', $id)->first();
                if ($record != null) {
                    $consultations=$record->consultations()->paginate(5);        
                    return view('consultations.epirxisk')->with([
                        'record' => $record
                        
                    ]);
                }
            }
        }
        $records=null;

 
        return view('consultations.epirxisk')->with(['records' => $records]);
    }

    /*

public function index()
    {
        $banks = Bank::paginate(25);
        
        if(!empty($banks[0])){
            return view('banks.index')->withBanks($banks);
        }
        Session::flash('flash_message', 'No records found!');
            return view('banks.index')->withBanks($banks);
        
    }

    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input=request()->all();
        $frs=null;
        $risklevel=null;
        
        if(request()->has('id')){
            $id=$input['id'];
            $patient=Patient::find($id);

        }
        if(isset($patient))
        {
            //from frs score
        }
        if(request()->has("frs_score"))
        {
         
        }
        if(request()->has("risklevel"))
        {
            
            $risklevel=request("risklevel");   
        }
     
        $keys=array_keys($patient->toArray());
        $consultations=$patient->consultations()->paginate(5000);        


        return view('consultations.create')->with(["record"=>$patient,
        'keys' => $keys,
        'consultations'=>$consultations,
        'patient'=>$patient,
        'frs'=>$frs,
        "risklevel"=>$risklevel]);
        //
    }
    public function score()
    {
        $input=request()->all();
        $patient=Patient::find(request()->input('id'));
        $frs=null;
        $risklevel=null;
        $keys=array_keys($patient->toArray());
        $consultations=$patient->consultations()->paginate(5000);      

        if(request()->has("frs_score"))
        {
            
            $calculator=new FraminghamRiskScoreCalculator(request()->input());           
            $frs= $calculator->calculateFRS(); 
            $details=[];
            foreach ($frs as $key => $value) {
                $details[]=array_keys($value);
            }
            $lastkey=array_key_last(end($frs));
            $percentage=end($frs)[$lastkey];
                
            $riskmsg=array_key_last(end($frs));   
            $risklevel="Error";   
            if($percentage<=10){
                $risklevel="Low Risk";
            }
            if($percentage>10&&$percentage<20){
                $risklevel="Intermediate Risk";
            }
            if($percentage>=20){
                $risklevel="High Risk";
            }
            $frssize=count($frs);
            for ($i=0; $i < $frssize; $i++) { 
                
                $innerKey=array_keys( $frs[array_keys($frs)[$i]])[0];
                $details[]=(array_merge( [$innerKey],Arr::flatten($frs[$i])) );
    
               
            }
        
        }
        
        //Session::flash('flash_message',$msg);
        Session::flash('flash_message',$riskmsg." ".$risklevel );


        return view('consultations.consult')->with(["record"=>$patient,
        'keys' => $keys,
        'consultations'=>$consultations,
        'patient'=>$patient,
        'frs'=>$frs,
        "risklevel"=>$risklevel,
        'details'=>$details,
        'id' => $input['id'],
        "patient_id" => $input['patient_id'],
        "frs_score" => $input['frs_score'],
        "gender" => $input['gender'],
        "age" =>$input['age'],
        "height" => $input['height'],
        "weight" => $input['weight'],
        "bmi" => $input['bmi'],
        "total_cholesterol" => $input['total_cholesterol'],
        "hdl_cholesterol" => $input['hdl_cholesterol'],
        "ldl_cholesterol" => $input['ldl_cholesterol'],
        "systolic_bp" => $input['systolic_bp'],
        "medication" => $input['medication'],
        "smokes" => $input['smokes'],
        "vital_id" => $input['vital_id']
        
        ]);
    
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsultationRequest $request)
    {
     
        $input=$request->all();
        unset($input['_token']);
        $patient=Patient::find($input['patient_id']);
        unset($input['vital_id']);


        unset($input['id']);
        unset($input['frs_score']);
        unset($input['gender']);
        unset($input['age']);
        unset($input['height']);
        unset($input['weight']);
        unset($input['bmi']);
        unset($input['total_cholesterol']);
        unset($input['hdl_cholesterol']);
        unset($input['ldl_cholesterol']);
        unset($input['systolic_bp']);
        unset($input['medication']);
        unset($input['smokes']);
        unset($input['vital_id']);

        PatientVital::where('has_seen_doctor?',false)
        ->where('patient_id',$patient->id)
        ->update(['has_seen_doctor?'=>true]);
        unset($input['patient_id']);
        
        $input["seen_by"]=\Auth::user()->name;
        
       $consultation=Consultation::create($input);

       $patient->consultations()->save($consultation);

       return redirect('consultations');
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        $record = $consultation;

        $id=ConsultationPatient::where('consultation_id',$consultation->id)->first();
        $patient=Patient::find($id->patient_id);

        return view('consultations.edit')->with(
            ['record' => $record,
            'patient'=>$patient]);
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(ConsultationRequest $request, Consultation $consultation)
    {
        $record = $consultation;
        $input = $request->all();
        $record->update($input);

        Session::flash('flash_message', 'Record successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {

        
        $input = request()->all();

        $record =Consultation::find($input['consultation_id']);
        ConsultationPatient::where("consultation_id",$input['consultation_id'])->delete();

    
        $record->delete();

        Session::flash('flash_message', 'Record successfully deleted!');

        return redirect()->back();
    }
    public function search(Request $request)
    {
        $records =[];
        $q = $request->q;
        if ($q != "") {
            $patient_ids=[];
            $patients=Patient::where('name','LIKE', '%' . $q . '%')->get();
            foreach ($patients as $key => $value) {
                $patient_ids[]=$value->id;
            }
           
            $records = PatientVital::whereIn('patient_id',$patient_ids)
                                    ->where("has_seen_doctor?","=",false)
                                    ->paginate(15)->setPath('');
            if (count($records) > 0) {
                return view('consultations.index')->with(['records' => $records]);
            }
        }
        Session::flash('flash_message', 'No records found! or Patient has been consulted');
        return redirect()->route('consultations.index')->with(['records' => $records]);

 
    }
}
