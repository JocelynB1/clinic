<?php
$visits=null;
if(isset($patient)){
$visits=$patient->visits->last();
$vitals=$patient->vitals->last();

//$patientVitals=DB::table('patient_vital')->where('patient_id',$patient->id)->get();
//
$labs=$patient->labs->last();
$consultationLength=count($patient->consultations->all());
$comments=$patient->consultations->all();
}else{
$patient=null;
}
?>
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
       
        <div class="col-md-5">
        
        <table class="table table-light table-hover table-light table-bordered table-sm table-striped table-responsive border-0">
        <tbody>
                 

        @if($patient==null)                    
            @else
        @include('patients.__show_patients_table')
        @endif
        @if($visits==null)        
           @else
        @include('visits.__show_visits_table')
        @endif
        @if($vitals==null)        
            @else
        @include('vitals.__show_vitals')
        @endif
      
        @if($labs==null)        
        @else
        @include('labs.__show_labs_table')
        @endif
    </tbody>
</table>

                </div>
                <div class="col-md-7">
@if($risklevel==null)
                    @include('consultations.__frs_form')
                           @endif
                                  
                   
                </div>
               
                </div>
</div>

@endsection
