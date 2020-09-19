<?php

namespace App\Http\Controllers;

use App\Lab;
use Illuminate\Http\Request;
use App\Helpers\PaginatedTableHelper;
use App\Helpers\ArrayPresentationHelper;
use Session;
use App\Patient;
use App\Http\Requests\LabRequest;
use App\LabPatient;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $phelper=new PaginatedTableHelper();
        $record = new Lab;
        $records = $phelper->buildPaginatedTable($record, 'id');
        $preskeys=new ArrayPresentationHelper($record);
        $keys=$preskeys->getSortedKeys();
       
        return view('labs.index')->with([
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
        return view('labs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabRequest $request)
    {
        $input=$request->all();
        $input["seen_by"]=\Auth::user()->name;

        unset($input['_token']);
        $patient=Patient::find($input['patient_id']);
        $id=$input['patient_id'];
        unset($input['patient_id']);
        unset($input['has_done_ecg']);
        unset($input['is_normal']);

        
        $lab=Lab::create($input);
        $patient->labs()->save($lab);
        
        Session::flash('flash_message', 'Success');
        
     //   return view('home');
        return redirect()->action('PatientController@review',['id'=>$id]);

        //return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        $record = $lab;
        $preskeys=new  ArrayPresentationHelper($record);
        $keys=$preskeys->getSortedKeys();

        return view('labs.show')->with(['record' => $record, 'keys' => $keys]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        $record = $lab;

        return view('labs.edit')->with(['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        $record = $lab;
        $input = $request->all();
        unset($input['patient_id']);
     
        $record->update($input);

        Session::flash('flash_message', 'Record successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        $record = $lab;
        $input = request()->all();

        $record =Lab::find($input['lab_id']);
        LabPatient::where("lab_id",$input['lab_id'])->delete();

        $record->delete();
        Session::flash('flash_message', 'Record successfully deleted!');


        return redirect()->back();
    }
}
