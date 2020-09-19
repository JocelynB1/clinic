<?php
$visits=null;
if(isset($patient)){
    $visits=$patient->visits->last();
    $vitals=$patient->vitals->last();
    $labs=$patient->labs->last();
    $consultationLength=count($patient->consultations->all());
    $comments=$patient->consultations->all();
    $consultations=$patient->consultations()->paginate(5000);        

}else{
    $patient=null;
}
?>
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-6">
        <table class="table table-light table-hover  table-bordered table-sm table-striped table-responsive border-0">
        <tbody>
                     
        @if($patient==null)                    
            @else
        @include('patients.__show_patients_table')
        @endif
      
        @if($comments==null)        
        @else
        @include('consultations.__comments')
        @endif

       
    </tbody>
</table>
</div>

<div class="col-md-6">
    <table class="table table-light table-hover  table-bordered table-sm table-striped table-responsive border-0">
    <tbody>
            @if($vitals==null)        
            @else
        @include('vitals.__show_vitals')
        @endif
            @if($visits==null)        
            @else
         @include('visits.__show_visits_table')
         @endif
         @if($labs==null)        
         @else
         @include('labs.__show_labs_table')
         @endif
  
      
    </tbody>
</table>
                </div>
            
                </div>
</div>
@endsection
