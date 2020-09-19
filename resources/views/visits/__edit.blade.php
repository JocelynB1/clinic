<div class="container-fluid" id="reviewVisits">
        <div class="row justify-content-center no-gutters">
            <div class="col-md-12">
             
            <div class="card">
                    <div class="card-header"><h1>Edit Medical History</h1></div>
    
                    <div class="card-body">
                            {!! 
                
                                Form::model($visits, [
                      'method' => 'PUT',
                      'action' => ['VisitController@update', $visits->id]
                                ]) !!}
    
    <fieldset>
            <legend></legend>
            
    
            {!! Form::hidden('patient_id',$patient->id,
            [
                "class"=>"form-control "
            ])
            !!}
           
      
            <div class="form-group row">
                    {!! Form::label("has_history_of_high_bp?","Does the patient have High Blood Pressure?",
                    ["class"=>"col-md-4 col-form-label text-md-right"])
                    !!}
                    <div class="col-md-8">
                          {!! Form::select('has_history_of_high_bp?',
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
                        {!! Form::label("has_history_of_diabetes?","Does the patient have Diabetes?",
                        ["class"=>"col-md-4 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-8">
                              {!! Form::select('has_history_of_diabetes?',
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
                            {!! Form::label("has_heart_disease?","Does the patient have Heart Disease?",
                            ["class"=>"col-md-4 col-form-label text-md-right"])
                            !!}
                            <div class="col-md-8">
                                  {!! Form::select('has_heart_disease?',
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
                                {!! Form::label("has_history_of_stroke?","Has the patient had a Stroke?",
                                ["class"=>"col-md-4 col-form-label text-md-right"])
                                !!}
                                <div class="col-md-8">
                                      {!! Form::select('has_history_of_stroke?',
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
                                    {!! Form::label("smokes?","Does the patient Smoke?",
                                    ["class"=>"col-md-4 col-form-label text-md-right"])
                                    !!}
                                    <div class="col-md-8">
                                          {!! Form::select('smokes?',
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

                                <fieldset>
                                    <legend style="text-align: center;">Is the patient on any medication?</legend>
                                    <div class="form-group row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                        <input type="radio" name="medications" id="yes"><label for="yes">Yes</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name="medications" id="no" checked><label for="no">No</label>
                                    </div>
                                    <div class="col-md-2"></div>
                                    </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    </div>
                                    <div class="medication">

                                        <div class="form-group row">
                                            {!! Form::label("takes_BB?","Does the patient take BB?",
                                            ["class"=>"col-md-4 col-form-label text-md-right"])
                                            !!}
                                            <div class="col-md-8">
                                                  {!! Form::select('takes_BB?',
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
                                                {!! Form::label("takes_CCB?","Does the patient take CCB?",
                                                ["class"=>"col-md-4 col-form-label text-md-right"])
                                                !!}
                                                <div class="col-md-8">
                                                      {!! Form::select('takes_CCB?',
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
                                                    {!! Form::label("takes_Diuretic?","Does the patient take Diuretic?",
                                                    ["class"=>"col-md-4 col-form-label text-md-right"])
                                                    !!}
                                                    <div class="col-md-8">
                                                          {!! Form::select('takes_Diuretic?',
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
                                                        {!! Form::label("takes_ARB?","Does the patient take ARB?",
                                                        ["class"=>"col-md-4 col-form-label text-md-right"])
                                                        !!}
                                                        <div class="col-md-8">
                                                              {!! Form::select('takes_ARB?',
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
                                                            {!! Form::label("takes_ACE_I?","Does the patient take ACE_I?",
                                                            ["class"=>"col-md-4 col-form-label text-md-right"])
                                                            !!}
                                                            <div class="col-md-8">
                                                                  {!! Form::select('takes_ACE_I?',
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
                                                                {!! Form::label("takes_ASA?","Does the patient take ASA?",
                                                                ["class"=>"col-md-4 col-form-label text-md-right"])
                                                                !!}
                                                                <div class="col-md-8">
                                                                      {!! Form::select('takes_ASA?',
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
                                                                    {!! Form::label("takes_insulin/OHA?","Does the patient take Insulin/OHA?",
                                                                    ["class"=>"col-md-4 col-form-label text-md-right"])
                                                                    !!}
                                                                    <div class="col-md-8">
                                                                          {!! Form::select('takes_insulin/OHA?',
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
                                    </div>
                   
                           
                </fieldset>
                <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                                <a href="#" id="confirmVisits" class="btn btn-success btn-lg">Confirm</a>
                            </div>
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
    