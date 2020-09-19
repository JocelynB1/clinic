<?php
if(isset($comments[0]))
$comments=$comments[count($comments)-1]->comment;
else {
    
    $comments=null;
}
?>
<div class="card border-0">
    <div class="card-header"><h1>Add Comment</h1></div>

    <div class="card-body">
{!! Form::open(['action' => 'ConsultationController@store']) !!}

<fieldset>
<legend>{{$patient->name}}'s Record</legend>



{!! Form::hidden('patient_id',$patient->id,
[
"class"=>"form-control "
])
!!}
 <div class="form-group row">
     <div class="col-md-2"></div>
    <div class="col-md-10">
        @include('consultations.__comments')
    </div>
 </div>
<div class="form-group row">
{!! Form::label("comment","Comment",
["class"=>"col-md-2 col-form-label text-md-right"])
!!}
<div class="col-md-10">
{!! Form::textarea("comment",$comments,
[
"placeholder"=>"",
"class"=>"form-control"
])
!!}
</div>
</div>

<div class="form-group row">
    {!! Form::label("cc_dlcl","CC/DLCL",
    ["class"=>"col-md-2 col-form-label text-md-right"])
    !!}
    <div class="col-md-10">
    {!! Form::text("cc_dlcl",null,
    [
    "placeholder"=>"",
    "class"=>"form-control",
    "style"=>" font-weight: bold;  font-size: 1.5rem;"
    
    ])
    !!}
    </div>
    </div>

<div class="form-group row">
    {!! Form::label("family_history","Family History",
    ["class"=>"col-md-2 col-form-label text-md-right"])
    !!}
    <div class="col-md-10">
          {!! Form::select('family_history',
          [""=>"Select",
         "Negative"=> "Negative",
         "Positive"=> "Positive"
        ]
          ,null,
    [
        "class"=>"form-control "
    ])
    !!}
    </div>
</div>

<div class="form-group row">
        {!! Form::label("disposal","Disposal",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
              {!! Form::select('disposal',
              [""=>"Select",
              "Initiate immediate treatment"=> "Initiate immediate treatment",
             "Refer to cardio protection clinic"=> "Refer to cardio protection clinic",
             "Repeat screen in the future- 1 month "=> "Repeat screen in the future- 1 month",
             "Repeat screen in the future- 3 months "=> "Repeat screen in the future- 3 months",
             "Repeat screen in the future- 6 months "=> "Repeat screen in the future- 6 months",
             "Repeat screen in the future- 1 year "=> "Repeat screen in the future- 1 year",
             "Repeat screen in the future- 2 years "=> "Repeat screen in the future- 2 years"
           
            ]
              ,null,
        [
            "class"=>"form-control "
        ])
        !!}
        </div>
    </div>    
    <div class="form-group row">
        {!! Form::label("risk_level_category","Risk Level Category",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
        <div class="col-md-10">
              {!! Form::select('risk_level_category',
              [""=>"Select",
              "Complete"=> "Complete",
             "Incomplete"=> "Incomplete",
           
            ]
              ,null,
        [
            "class"=>"form-control "
        ])
        !!}
        </div>
    </div>    
<div class="form-group row">
{!! Form::label("risk_level","Risk Level",
["class"=>"col-md-2 col-form-label text-md-right"])
!!}
<div class="col-md-10">
{!! Form::text("risk_level",$risklevel,
[
"placeholder"=>"",
"class"=>"form-control",
"style"=>" font-weight: bold;  font-size: 1.5rem;"

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
    {!! Form::submit('Submit ', [
        'class' => 'btn btn-primary  btn-lg ',
        'id'=>'submit'
        ]) !!}
    {!! Form::close() !!}

</div>

</div>


</div>
    </div>