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



$js=<<<JS
          
let fields = [
              "comment",
              "cc_dlcl",
              "family_history",
              "disposal",
              "risk_level_category",
              "risk_level"
              ];
document.querySelector("#submit").disabled = true;

function validate(fields) {
    for (let i = 0; i < fields.length; i++) {
        if (document.querySelector("#" + fields[i]).value == "") {
          generateAlert(fields[i] + " is required.");
            return;
        }
    }
    document.querySelector("#submit").disabled = false;
}

document.querySelector("#family_history").addEventListener('blur', function (e) {

validate(fields);
if (e.target != e.currentTarget) {
    e.preventDefault();
}
e.stopPropagation();
}, false);

document.querySelector("#disposal").addEventListener('blur', function (e) {

    validate(fields);
    if (e.target != e.currentTarget) {
        e.preventDefault();
    }
    e.stopPropagation();
}, false);


document.querySelector("#risk_level").addEventListener('blur', function (e) {

    validate(fields);
    if (e.target != e.currentTarget) {
        e.preventDefault();
    }
    e.stopPropagation();

}, false);

document.querySelector("#risk_level_category").addEventListener('blur', function (e) {

    validate(fields);
    if (e.target != e.currentTarget) {
        e.preventDefault();
    }
    e.stopPropagation();
}, false);


document.querySelector("#cc_dlcl").addEventListener('blur', function (e) {

    validate(fields);
    if (e.target != e.currentTarget) {
        e.preventDefault();
    }
    e.stopPropagation();
}, false);

document.querySelector("#comment").addEventListener('blur', function (e) {

    validate(fields);
    if (e.target != e.currentTarget) {
        e.preventDefault();
    }
    e.stopPropagation();
}, false);

function generateAlert(txt) {
    // create new text and div elements and set
    // Aria and class values and id
    var div=document.querySelector("#valid");
    var txtNd = document.createTextNode(txt);
    msg = document.createElement("div");
    msg.setAttribute("role", "alert");
    msg.setAttribute("id", "msg");
    $("#valid").empty();
    msg.setAttribute("class", "alert");
    // append text to div, div to document
    msg.appendChild(txtNd);
  
    div.appendChild(msg);
}
JS;


?>
@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center no-gutters">
    <div id="valid" style="background-color:red; color:white; width:100%; font:bold; "></div>
  </div>
    <div class="row justify-content-center no-gutters">
        <div class="col-md-5">
                <div class="accordion" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Framingham Risk Score for Hard Coronary Heart Disease Score Breakdown
                              </button>
                            </h2>
                          </div>
                      
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                    <table class="table table-light table-hover table-light table-bordered table-sm table-striped table-responsive border-0">
                                        <thead>
                                            <th>Criteria</th>
                                            <th>Value</th>
                                            <th>Total Points</th>
                                            </thead>  
                                        <tbody>
                                                @for ($i = 0; $i < count($details); $i++)     
                                            <tr> 
                                                

                                                 
                                                    @foreach ($details[$i] as $item)
                                                    <td>{{$item}}</td>
                                                    @endforeach
                                                       
                                           
                                          
                                            </tr>
                                             @endfor      

                                        </tbody>
                                    </table>
                                    <iframe src="https://www.epicore.ualberta.ca/epirxisk/screening" width="100%" height="1000"></iframe>                                    
                            </div>
                          </div>
                        </div>
        
                      </div>
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
                                    <br>
                        <br>
                    @include("consultations.__create")
                   
                </div>
               
                </div>
</div>

@endsection

@section('scripts')
{!!$js!!}  
@endsection