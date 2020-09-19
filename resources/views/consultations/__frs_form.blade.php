<?php
$isOnMedication="No";
if($visits['takes_BB?']!=null){
    $isOnMedication="Yes";
}
if($visits['takes_CCB?']!=null){
    $isOnMedication="Yes";    
}
if($visits['takes_Diuretic?']!=null){
    $isOnMedication="Yes";    
}
if($visits['takes_ARB?']!=null){
    $isOnMedication="Yes";    
}
if($visits['takes_ACE_I?']!=null){
    $isOnMedication="Yes";
}
if($visits['takes_ASA?']!=null){
    $isOnMedication="Yes";    
}
if($visits['takes_insulin/OHA?']!=null){
    $isOnMedication="Yes";
}
$patientSmokes="No";
if($visits['smokes?']!=null){
    $patientSmokes="Yes";
}

?>
<div class="card border-0">
  
    <div class="card-body">
{!! Form::open(['action' => 'ConsultationController@score']) !!}

<fieldset>
<legend>Calculate FRS score for {{$patient->name}}</legend>


{!! Form::hidden("id",$patient->id)!!}
{!! Form::hidden("patient_id",$patient->id)!!}
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
              ,$patient->gender,
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
            {!! Form::text("age",today()->diffInYears($patient->birth_date),
            [
                "placeholder"=>"Age",
                "class"=>"form-control"
            ])
            !!}
            </div>
        </div>
        <fieldset>
                <legend>Physical Examination</legend>


            <div class="form-group row">
                {!! Form::label("height","Height",
                ["class"=>"col-md-2 col-form-label text-md-right"])
                !!}
                {!! Form::text("height",$vitals->height,
                [
                    "placeholder"=>"",
                    "class"=>"form-control col-md-2"
                ])
                !!}
                   {!! Form::label("weight","Weight",
                   ["class"=>"col-md-2 col-form-label text-md-right"])
                   !!}
                   {!! Form::text("weight",$vitals->weight,
                   [
                       "placeholder"=>"",
                       "class"=>"form-control col-md-2"
                   ])
                   !!}
              {!! Form::label("bmi","BMI",
              ["class"=>"col-md-2 col-form-label text-md-right"])
              !!}
              {!! Form::text("bmi",$vitals->bmi,
              [
                  "placeholder"=>"",
                  "class"=>"form-control col-md-2"
              ])
              !!}
                   
               
            </div>
        </fieldset>
        <div class="form-group row">
            {!! Form::label("total_cholesterol","Total Cholesterol",
            ["class"=>"col-md-auto col-form-label text-md-right"])
            !!}
            <div class="col-md-9">
            {!! Form::text("total_cholesterol",$labs->total_cholesterol,
            [
                "placeholder"=>"mg/dL",
                "class"=>"form-control"
            ])
            !!}
            </div>
        </div>        
        <div class="form-group row">
            {!! Form::label("hdl_cholesterol","HDL Cholesterol",
            ["class"=>"col-md-auto col-form-label text-md-right"])
            !!}
            <div class="col-md-9">
            {!! Form::text("hdl_cholesterol",$labs->hdl_cholesterol,
            [
                "placeholder"=>"mg/dL",
                "class"=>"form-control"
            ])
            !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label("ldl_cholesterol","LDL Cholesterol",
            ["class"=>"col-md-auto col-form-label text-md-right"])
            !!}
            <div class="col-md-9">
            {!! Form::text("ldl_cholesterol",$labs->ldl_cholesterol,
            [
                "placeholder"=>"mg/dL",
                "class"=>"form-control"
            ])
            !!}
            </div>
        </div>
                <div class="form-group row">
                        {!! Form::label("systolic_bp","Systolic",
                        ["class"=>"col-md-auto col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                        {!! Form::text("systolic_bp",$vitals->systolic_bp,
                        [
                            "placeholder"=>"Systolic",
                            "class"=>"form-control"
                        ])
                        !!}
                        </div>
                    </div>
                    <div class="form-group row">
                            {!! Form::label("medication","On Medication for High Blood pressure",
                            ["class"=>"col-md-auto col-form-label text-md-right"])
                            !!}
                            <div class="col-md-6">
                                  {!! Form::select('medication',
                                  [""=>"Select",
                                 "Yes"=> "Yes",
                                 "No"=> "No"
                                ]
                                  ,$isOnMedication,
                            [
                                "class"=>"form-control "
                            ])
                            !!}
                            </div>
                        </div>
                        <div class="form-group row">
                                {!! Form::label("smokes","Smokes?",
                                ["class"=>"col-md-auto col-form-label text-md-right"])
                                !!}
                                <div class="col-md-10">
                                      {!! Form::select('smokes',
                                      [""=>"Select",
                                     "Yes"=> "Yes",
                                     "No"=> "No"
                                    ]
                                      ,$patientSmokes,
                                [
                                    "class"=>"form-control "
                                ])
                                !!}
                                </div>
                            </div> 




{!! Form::hidden("vital_id",$vitals->id,
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