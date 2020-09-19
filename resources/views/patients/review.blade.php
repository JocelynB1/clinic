<?php
$visits=null;
$vitals=null;
$labs=null;
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


$js=<<<JS
        document.querySelector(".medication").style.display="None";
        var confirmCount=1;
        if(document.querySelector("#confirmLabs")==null){
            confirmCount++;
        }
        document.querySelector("#confirmPatient").addEventListener('click', function (e) {
        document.querySelector("#reviewPatient").style.display="None";
        confirmCount++;
        checkCompletion(confirmCount);
      if (e.target != e.currentTarget) {
              e.preventDefault();
          }
          e.stopPropagation();
      }, false);
        

      document.querySelector("#confirmVisits").addEventListener('click', function (e) {
        document.querySelector("#reviewVisits").style.display="None";
        confirmCount++;
        checkCompletion(confirmCount);

      if (e.target != e.currentTarget) {
              e.preventDefault();
          }
          e.stopPropagation();
      }, false);
   
    
      document.querySelector("#confirmVitals").addEventListener('click', function (e) {
        document.querySelector("#reviewVitals").style.display="None";
        confirmCount++;
        checkCompletion(confirmCount);

      if (e.target != e.currentTarget) {
              e.preventDefault();
          }
          e.stopPropagation();
      }, false);
   
      document.querySelector("#confirmLabs").addEventListener('click', function (e) {
        document.querySelector("#reviewLabs").style.display="None";
        confirmCount++;
        checkCompletion(confirmCount);

      if (e.target != e.currentTarget) {
              e.preventDefault();
          }
          e.stopPropagation();
      }, false);
   
        document.querySelector("#yes").addEventListener('change', function (e) {
        if(document.querySelector("#yes").checked==true){
            document.querySelector(".medication").style.display="Block";
        }
        if(document.querySelector("#no").checked==true){
            document.querySelector(".medication").style.display="None";
        }
        if (e.target != e.currentTarget) {
                e.preventDefault();
            }
            e.stopPropagation();
        }, false);

        document.querySelector("#no").addEventListener('change', function (e) {
      
        if(document.querySelector("#no").checked==true){
            document.querySelector(".medication").style.display="None";
        }
        if (e.target != e.currentTarget) {
                e.preventDefault();
            }
            e.stopPropagation();
        }, false);

function checkCompletion(steps){
   
if(steps==5)
{

    document.querySelector("#review").style.display="None";
    document.querySelector("#progress").style.display="None";
        document.querySelector("#h3").style.display="None";
   
}
}
JS;
?>
@extends('layouts.app')
@section('progress')
<h3 id="h3">Step 5 of 5</h3>
<div class="progress" id="progress">


  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>
</div>
@endsection
@section('content')
<fieldset id="review">
    <legend style="text-align: center;"><h1>Review And Confirm</h1></legend>
</fieldset>
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
         @if($patient==null)                    
                 @else
                 <h2 class="dark">ID: {{$patient->pid}}</h2>
            @include('patients.__edit')
        @endif
        @if($visits==null)        
        @else
        <hr>
        @include('visits.__edit')
        @endif
        @if($vitals==null)        
        @else
        <hr>
        @include('vitals.__edit')
        @endif
        @if($labs==null)        
        @else
        <hr>
        @include('labs.__edit')
        @endif
       
              
               
            
</div>
@endsection
@section('scripts')
 {!!$js!!}   
@endsection