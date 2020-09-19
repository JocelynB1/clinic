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
<div class="card border-0">
  
    <div class="card-body">
{!! Form::open(['action' => 'ConsultationController@score']) !!}

<fieldset>
<legend>Calculate FRS score </legend>


{!! Form::hidden("frs_score","frs_score")!!}
<div class="form-group row">
        {!! Form::label("gender","Gender",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
              {!! Form::select('gender',
              [""=>"Select",
             "Male"=> "Male",
             "Female"=> "Female"
            ]
              ,null,
        [
            "class"=>"form-control "
        ])
        !!}
        </div>
    </div>    
    <div class="form-group row">
            {!! Form::label("age","Age",
            ["class"=>"col-md-2 col-form-label text-md-right"])
            !!}
            <div class="col-md-10">
            {!! Form::text("age",null,
            [
                "placeholder"=>"Age",
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
                        {!! Form::label("systolic_bp","Systolic",
                        ["class"=>"col-md-2 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                        {!! Form::text("systolic_bp",null,
                        [
                            "placeholder"=>"Systolic",
                            "class"=>"form-control"
                        ])
                        !!}
                        </div>
                    </div>
                    <div class="form-group row">
                            {!! Form::label("medication","On Medication for High Blood pressure",
                            ["class"=>"col-md-2 col-form-label text-md-right"])
                            !!}
                            <div class="col-md-10">
                                  {!! Form::select('medication',
                                  [""=>"Select",
                                 "Yes"=> "Yes",
                                 "No"=> "No"
                                ]
                                  ,null,
                            [
                                "class"=>"form-control "
                            ])
                            !!}
                            </div>
                        </div>
                        <div class="form-group row">
                                {!! Form::label("smokes","Smokes?",
                                ["class"=>"col-md-2 col-form-label text-md-right"])
                                !!}
                                <div class="col-md-10">
                                      {!! Form::select('smokes',
                                      [""=>"Select",
                                     "Yes"=> "Yes",
                                     "No"=> "No"
                                    ]
                                      ,null,
                                [
                                    "class"=>"form-control "
                                ])
                                !!}
                                </div>
                            </div> 




{!! Form::hidden("vital_id",null,
[

])!!}

 





</fieldset>
<div class="form-group row">
<div class="col-md-6"></div>
<div class="col-md-auto">
    {!! Form::submit('Submit ', ['class' => 'btn btn-primary  btn-lg ']) !!}
    {!! Form::close() !!}

</div>

</div>


</div>
    </div>
    
@endsection