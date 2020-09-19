@extends('layouts.app')



@section('content')
<div class="container-fluid" >
        <div class="row justify-content-center no-gutters">
            <div class="col-md-12">
             
            <div class="card">
                    <div class="card-header"><h1>{{$patient->name}}'s Record</h1></div>
    
                    <div class="card-body">
                            {!! 
                
                                Form::model($record, [
                      'method' => 'PUT',
                      'action' => ['ConsultationController@update', $record->id]
                                ]) !!}
    
    <fieldset>
        <legend></legend>
        
                       
        
       <div class="form-group row">
            {!! Form::label("comment","Comment",
            ["class"=>"col-md-2 col-form-label text-md-right"])
            !!}
            <div class="col-md-10">
            {!! Form::textarea("comment",null,
            [
            "placeholder"=>"",
            "class"=>"form-control"
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
                        {!! Form::label("risk_level","Risk Level",
                        ["class"=>"col-md-2 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                        {!! Form::text("risk_level",null,
                        [
                        "placeholder"=>"",
                        "class"=>"form-control"
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
                    
        
            
         
              
           
                   
            </fieldset>
            <div class="form-group row">
                <div class="col-md-6"></div>
               
                <div class="col-md-auto">
                        {!! Form::submit('Update ', ['class' => 'btn btn-secondary btn-lg']) !!}
                
                </div>
        </div>
        
    {!! Form::close() !!}
    
            </div>
                    </div>
                    </div>
    </div>
    </div>
    
@endsection
