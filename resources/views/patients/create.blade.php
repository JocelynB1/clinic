@extends('layouts.app')


@section('progress')

<h3>Step 1 of 5</h3>
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
  </div>
</div>


@endsection
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>Patient Details</h1></div>

                <div class="card-body">
           {!! Form::open(['action' => 'PatientController@store']) !!}

           <fieldset>
                <legend></legend>
                
                        
                <div class="form-group row">
                        {!! Form::label("name","Patient's name",
                        ["class"=>"col-md-2 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                        {!! Form::text("name",null,
                        [
                            "placeholder"=>"First Name, Other Names, Last Name",
                            "class"=>"form-control"
                        ])
                        !!}
                        </div>
                    </div>
                         
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
                            {!! Form::label("birth_date","Birthdate",
                            ["class"=>"col-md-2 col-form-label text-md-right"])
                            !!}
                            <div class="col-md-10">
                            {!! Form::date("birth_date",null,
                            [
                                "class"=>"form-control"
                            ])
                            !!}
                            </div>
                        </div>
                
                        <div class="form-group row">
                            {!! Form::label("area_of_residence","Area Of Residence",
                            ["class"=>"col-md-2 col-form-label text-md-right"])
                            !!}
                            <div class="col-md-10">
                            {!! Form::textarea("area_of_residence",null,
                            [
                                "placeholder"=>"Home Address",
                                "class"=>"form-control"
                            ])
                            !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label("mobile_phone_number","Mobile Phone #",
                            ["class"=>"col-md-2 col-form-label text-md-right"])
                            !!}
                            <div class="col-md-10">
                            {!! Form::tel("mobile_phone_number",null,
                            [
                                "placeholder"=>"0241667610",
                                "class"=>"form-control"
                            ])
                            !!}
                            </div>
                        </div>
                
                        <div class="form-group row">
                            {!! Form::label("alternative_phone_number","Alternative Phone #",
                            ["class"=>"col-md-2 col-form-label text-md-right"])
                            !!}
                            <div class="col-md-10">
                            {!! Form::tel("alternative_phone_number",null,
                            [
                                "placeholder"=>"0241667610",
                                "class"=>"form-control"
                            ])
                            !!}
                            </div>
                        </div>



                        
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
