<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Http\Request;
use App\Helpers\PaginatedTableHelper;
use App\Helpers\ArrayPresentationHelper;
use Session;
use App\Patient;
use App\Http\Requests\VisitRequest;
use App\PatientVisit;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phelper=new PaginatedTableHelper();
        $record = new Visit;
        $records = $phelper->buildPaginatedTable($record, 'id');
        $preskeys=new ArrayPresentationHelper($record);
        $keys=$preskeys->getSortedKeys();
       
        return view('visits.index')->with([
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
   
        if(request()->has('patient_id')){
            $patient= Patient::find(request('patient_id'));
        }else{
            $patient=null;
        }
        return view('visits.create')->with(['patient'=>$patient]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitRequest $request)
    {
        
        $input=$request->all();
        unset($input['_token']);
        $patient=Patient::find($input['patient_id']);
        
        unset($input['patient_id']);
        unset($input['medications']);

        $input["seen_by"]=\Auth::user()->name;
        
        $visit=Visit::create($input);
        $patient->visits()->save($visit);
        
      //  Session::flash('flash_message', 'Visit Recorded!');

        
        Session::flash('flash_message', 'Medical History recorded !, Please record the patients vitals');
        return view('vitals.create')->with(['patient'=>$patient]);


     //   return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        $record = $visit;
        $preskeys=new  ArrayPresentationHelper($record);
        $keys=$preskeys->getSortedKeys();

        return view('visits.show')->with(['record' => $record, 'keys' => $keys]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        $record = $visit;

        return view('visits.edit')->with(['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        $record = $visit;
        $input = $request->all();
        unset($input['patient_id']);
        unset($input['medications']);

        $record->update($input);

        Session::flash('flash_message', 'Record successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {

        $input = request()->all();

        $record =Visit::find($input['visit_id']);
        PatientVisit::where("visit_id",$input['visit_id'])->delete();

        $record->delete();

        Session::flash('flash_message', 'Record successfully deleted!');

        return redirect()->back();
    }
}
