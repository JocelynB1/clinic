<?php

namespace App\Http\Controllers;

use App\Vital;
use Illuminate\Http\Request;
use App\Helpers\PaginatedTableHelper;
use App\Helpers\ArrayPresentationHelper;
use Session;
use App\Patient;
use App\Http\Requests\VitalRequest;
use App\PatientVital;

class VitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phelper=new PaginatedTableHelper();
        $record = new Vital;
        $records = $phelper->buildPaginatedTable($record, 'id');
        $preskeys=new ArrayPresentationHelper($record);
        $keys=$preskeys->getSortedKeys();
       
        return view('vitals.index')->with([
            'records' => $records,
            'keys' => $keys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
    * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vitals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VitalRequest $request)
    {
        
        $input=$request->all();
        unset($input['_token']);
        $patient=Patient::find($input['patient_id']);

        unset($input['patient_id']);
        $heightInMeters=$input["height"]/100;
        $heightInMetersSquared=$heightInMeters*$heightInMeters;
        $input['bmi']=number_format($input['weight']/$heightInMetersSquared,2);
        if($input['bmi']<20){
            $input['bmi_level']="Normal";
        }
        if($input['bmi']>=21 &&$input['bmi']<=30){
            $input['bmi_level']="OW";

        }
        if($input['bmi']>30){
            $input['bmi_level']="OB";

        }

        $systolicBp=\number_format($input['systolic_bp'],2);
        $diastolicBp=\number_format($input['diastolic_bp'],2);
        $input['bp_category']="Unclassified";

       if($systolicBp<=120&&$diastolicBp<=80)
       {
        $input['bp_category']="Normal";

       }
       if(($systolicBp>120&&$systolicBp<=129)&&$diastolicBp<=80)
       {
        $input['bp_category']="Elevated";

       }
       if(($systolicBp>=130&&$systolicBp<=139)&&($diastolicBp>=80&&$diastolicBp<=89))
       {
        $input['bp_category']="Stage 1";

       }
       if(($systolicBp>=140)&&$diastolicBp>=90)
       {
        $input['bp_category']="Stage 2";

       }

     
        $input["seen_by"]=\Auth::user()->name;

        $vital=Vital::create($input);

        $patient->vitals()->save($vital);
        
    //    Session::flash('flash_message', 'Vital Recorded!');
     //   return redirect()->back();
       
     Session::flash('flash_message', 'Vitals recorded , Please Add any Lab results');
     return view('labs.create')->with(['patient'=>$patient]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function show(Vital $vital)
    {
        $record = $vital;
        $preskeys=new  ArrayPresentationHelper($record);
        $keys=$preskeys->getSortedKeys();

        return view('vitals.show')->with(['record' => $record, 'keys' => $keys]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function edit(Vital $vital)
    {
        $record = $vital;

        return view('vitals.edit')->with(['record' => $record]);
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vital $vital)
    {
        $record = $vital;
        $input = $request->all();
        unset($input['patient_id']);
     
        $record->update($input);

        Session::flash('flash_message', 'Record successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vital $vital)
    {
        $input = request()->all();

        $record =Vital::find($input['vital_id']);
        PatientVital::where("vital_id",$input['vital_id'])->delete();

        $record->delete();

        Session::flash('flash_message', 'Record successfully deleted!');

        return redirect()->back();
    }
}
