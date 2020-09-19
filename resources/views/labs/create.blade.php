<?php
if(isset($patient)){
    $patient=$patient->id;
}else {
            
$patient=null;    
}
$js=<<<JS

document.querySelector(".is_normal").style.display="None";
        document.querySelector("#yes").addEventListener('change', function (e) {
        if(document.querySelector("#yes").checked==true){
            document.querySelector(".is_normal").style.display="Block";
            document.querySelector("#ecg").options.selectedIndex=7;

        }
        if(document.querySelector("#no").checked==true){
            document.querySelector(".is_normal").style.display="None";
        }
        if (e.target != e.currentTarget) {
                e.preventDefault();
            }
            e.stopPropagation();
        }, false);

        document.querySelector(".ecg").style.display="None";
        document.querySelector("#Abnormal").addEventListener('change', function (e) {
        if(document.querySelector("#Abnormal").checked==true){
            document.querySelector(".ecg").style.display="Block";
            document.querySelector("#ecg").options.selectedIndex=0;

        }
        if(document.querySelector("#Normal").checked==true){
            document.querySelector(".ecg").style.display="None";
            document.querySelector("#ecg").options.selectedIndex=7;
            
        }
        if (e.target != e.currentTarget) {
                e.preventDefault();
            }
            e.stopPropagation();
        }, false);

        document.querySelector("#Normal").addEventListener('change', function (e) {
      
        if(document.querySelector("#Normal").checked==true){
            document.querySelector(".ecg").style.display="None";
            document.querySelector("#ecg").options.value="Normal";
            document.querySelector("#ecg").options.selectedIndex=7;

        }
        if (e.target != e.currentTarget) {
                e.preventDefault();
            }
            e.stopPropagation();
        }, false);

JS;
?>
@extends('layouts.app')

@section('progress')
<h3>Step 4 of 5</h3>
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
  </div>
</div>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>Lab Results</h1></div>

                <div class="card-body">
           {!! Form::open(['action' => 'LabController@store']) !!}

<fieldset>
<legend></legend>

       
          {!! Form::hidden('patient_id',$patient,
    [
        "class"=>"form-control "
    ])
    !!}
  <div class="form-group row">
    {!! Form::label("random_blood_sugar","Random Blood Sugar",
    ["class"=>"col-md-2 col-form-label text-md-right"])
    !!}
    <div class="col-md-10">
    {!! Form::text("random_blood_sugar",null,
    [
        "placeholder"=>"Random Blood Sugar",
        "class"=>"form-control"
    ])
    !!}
    </div>
</div>
<div class="form-group row">
        {!! Form::label("fasting_blood_sugar","Fasting Blood Sugar",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
        {!! Form::text("fasting_blood_sugar",null,
        [
            "placeholder"=>"Blood Sugar",
            "class"=>"form-control"
        ])
        !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label("hba1c","HbA1c",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
        {!! Form::text("hba1c",null,
        [
            "placeholder"=>"HbA1c",
            "class"=>"form-control"
        ])
        !!}
        </div>
    </div>              

    <div class="form-group row">
        {!! Form::label("total_cholesterol","Total Cholesterol",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
        {!! Form::text("total_cholesterol",null,
        [
            "placeholder"=>"mg/dL",
            "class"=>"form-control"
        ])
        !!}
        </div>
    </div>        
    <div class="form-group row">
        {!! Form::label("hdl_cholesterol","HDL Cholesterol",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
        {!! Form::text("hdl_cholesterol",null,
        [
            "placeholder"=>"mg/dL",
            "class"=>"form-control"
        ])
        !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label("ldl_cholesterol","LDL Cholesterol",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
        {!! Form::text("ldl_cholesterol",null,
        [
            "placeholder"=>"mg/dL",
            "class"=>"form-control"
        ])
        !!}
        </div>
    </div>
   
    <div class="form-group row">
            {!! Form::label("bun","Bun",
            ["class"=>"col-md-2 col-form-label text-md-right"])
            !!}
            <div class="col-md-10">
            {!! Form::text("bun",null,
            [
                "placeholder"=>"Bun",
                "class"=>"form-control"
            ])
            !!}
            </div>
        </div>  
             
        <div class="form-group row">
                {!! Form::label("creatinine","Creatinine",
                ["class"=>"col-md-2 col-form-label text-md-right"])
                !!}
                <div class="col-md-10">
                {!! Form::text("creatinine",null,
                [
                    "placeholder"=>"Creatinine",
                    "class"=>"form-control"
                ])
                !!}
                </div>
            </div>
            <div class="renal_function">
                <div class="form-group   row">
                        {!! Form::label("renal_function","Renal Function",
                        ["class"=>"col-md-2 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                                <select name="renal_function" id="renal_function" class="form-control" >
                                    <option value="" selected></option>
                                      
                                                <option value="Mild">Mild</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="Severe">Severe</option>
                                       
                                                                 
                                    </select>
                              
                        </div>
                    </div>    
                </div>
               
           
           
            <fieldset>
                <legend style="text-align: center;">Has the patient done any ecg?</legend>
          
            <div class="form-group row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                <input type="radio" name="has_done_ecg" id="yes"><label for="yes">Yes</label>
            </div>
            <div class="col-md-4">
                <input type="radio" name="has_done_ecg" id="no" checked><label for="no">No</label>
            </div>
            <div class="col-md-2"></div>
            </div>
            </div>
            <div class="col-md-4"></div>
            </div>
            <div class="is_normal">
                <div class="form-group row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                    <input type="radio" name="is_normal" id="Normal" checked><label for="Normal">Normal</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" name="is_normal" id="Abnormal" ><label for="Abnormal">Abnormal</label>
                </div>
                <div class="col-md-2"></div>
                </div>
                </div>
                <div class="col-md-4"></div>
                </div>
            </div>
         <div class="ecg">
        <div class="form-group   row">
                {!! Form::label("ecg","ECG",
                ["class"=>"col-md-2 col-form-label text-md-right"])
                !!}
                <div class="col-md-10">
                        <select name="ecg" id="ecg" class="form-control" >
                            <option value="" selected></option>
                              
                                        <option value="Myocardial Infraction">Myocardial Infraction</option>
                                        <option value="Left Ventricular Hypertrophy">Left Ventricular Hypertrophy</option>
                                        <option value="Artial Fibrillation/Flutter ">Artial Fibrillation/Flutter </option>
                                        <option value="Left and Right bundle branch Block ">Left and Right bundle branch Block</option>
                                        <option value="ST-segment and/or T-wave abnormalites">ST-segment and/or T-wave abnormalites</option>
                                        <option value="Second and third atrioventricular blocks">Second and third atrioventricular blocks</option>
                                        <option value="Normal" hidden>Normal</option>
                                
                                                         
                            </select>
                      
                </div>
            </div>    
        </div>
        </fieldset>
        

           
    </fieldset>
    <div class="form-group row">
        <div class="col-md-6"></div>
        <div class="col-md-auto">
                {!! Form::submit('Submit ', ['class' => 'btn btn-lg btn-primary']) !!}
                {!! Form::close() !!}

        </div>
        <div class="col-md-auto">
            {!! Form::open(['action' => 'HomeController@index',
             'method' => 'GET']
           ) !!}
            {!! Form::submit('Skip ', ['class' => 'btn btn-secondary  btn-lg ']) !!}

            {!! Form::close() !!}

        </div>
</div>


        </div>
                </div>
                </div>
</div>
</div>
@endsection
@section('scripts')
 {!!$js!!}   
@endsection