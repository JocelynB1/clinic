<?php
if(isset($patient)){
    $patient=$patient->id;
}else {
            
$patient=null;    
}
?>
@extends('layouts.app')


@section('progress')
<h3>Step 3 of 5</h3>
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
  </div>
</div>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>Vitals</h1></div>

                <div class="card-body">
           {!! Form::open(['action' => 'VitalController@store']) !!}

<fieldset>
<legend></legend>

        

              {!! Form::hidden('patient_id',$patient,
        [
            "class"=>"form-control "
        ])
        !!}
         
        
        
<div class="form-group row">
        {!! Form::label("weight","Weight",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
        {!! Form::text("weight",null,
        [
            "placeholder"=>"Kg",
            "class"=>"form-control"
        ])
        !!}
        </div>
    </div>
    <div class="form-group row">
            {!! Form::label("height","Height",
            ["class"=>"col-md-2 col-form-label text-md-right"])
            !!}
            <div class="col-md-10">
            {!! Form::text("height",null,
            [
                "placeholder"=>"Height",
                "class"=>"form-control"
            ])
            !!}
            </div>
        </div>
        <div class="form-group row">
                {!! Form::label("abdominal_girth","Abdominal Girth",
                ["class"=>"col-md-2 col-form-label text-md-right"])
                !!}
                <div class="col-md-10">
                {!! Form::text("abdominal_girth",null,
                [
                    "placeholder"=>"Abdominal girth",
                    "class"=>"form-control"
                ])
                !!}
                </div>
            </div>
          
       
                <div class="form-group row">
                        {!! Form::label("systolic_bp","Systolic BP",
                        ["class"=>"col-md-2 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                        {!! Form::text("systolic_bp",null,
                        [
                            "placeholder"=>"mmHg",
                            "class"=>"form-control"
                        ])
                        !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        {!! Form::label("diastolic_bp","Diastolic BP",
                        ["class"=>"col-md-2 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                        {!! Form::text("diastolic_bp",null,
                        [
                            "placeholder"=>"mmHg",
                            "class"=>"form-control"
                        ])
                        !!}
                        </div>
                    </div>
      
        <div class="form-group row">
            {!! Form::label("heart_rate","Heart Rate",
            ["class"=>"col-md-2 col-form-label text-md-right"])
            !!}
            <div class="col-md-10">
            {!! Form::text("heart_rate",null,
            [
                "placeholder"=>"bpm",
                "class"=>"form-control"
            ])
            !!}
            </div>
        </div>

      


           
    </fieldset>
    <div class="form-group row">
            <div class="col-md-6"></div>
            <div class="col-md-auto">
                    {!! Form::submit('Next ', ['class' => 'btn btn-primary btn-lg ']) !!}
            </div>
    </div>
   
{!! Form::close() !!}

        </div>
                </div>
                </div>
</div>
</div>
@endsection
