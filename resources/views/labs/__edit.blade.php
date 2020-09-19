
<div class="container-fluid" id="reviewLabs">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>Lab Results</h1></div>

                <div class="card-body">
                        {!! 
            
                            Form::model($labs, [
                  'method' => 'PUT',
                  'action' => ['LabController@update', $labs->id]
                            ]) !!}

<fieldset>
    <legend></legend>
    
                   
    
    {!! Form::hidden('patient_id',$patient->id,
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
                <div class="form-group row">
                    {!! Form::label("renal_function","Renal Function",
                    ["class"=>"col-md-2 col-form-label text-md-right"])
                    !!}
                    <div class="col-md-10">
                            <select name="renal_function" id="renal_function" class="form-control" >
                                <option value="{{$labs->renal_function}}" selected>{{$labs->ecg}}</option>
                                  
                                            <option value="Mild">Mild</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="Severe">Severe</option>
                                    
                                                             
                                </select>
                          
                    </div>
                </div>  
  
                <div class="form-group row">
                        {!! Form::label("ecg","ECG",
                        ["class"=>"col-md-2 col-form-label text-md-right"])
                        !!}
                        <div class="col-md-10">
                                <select name="ecg" id="ecg" class="form-control" >
                                    <option value="{{$labs->ecg}}" selected>{{$labs->ecg}}</option>
                                      
                                    <option value="Myocardial Infraction">Myocardial Infraction</option>
                                                <option value="Left Ventricular Hypertrophy">Left Ventricular Hypertrophy</option>
                                                <option value="Artial Fibrillation/Flutter ">Artial Fibrillation/Flutter </option>
                                                <option value="Left and Right bundle branch Block ">Left and Right bundle branch Block</option>
                                                <option value="ST-segment and/or T-wave abnormalites">ST-segment and/or T-wave abnormalites</option>
                                                <option value="Second and third atrioventricular blocks">Second and third atrioventricular blocks</option>
                                        
                                                                 
                                    </select>
                              
                        </div>
                    </div>  
    
               
        </fieldset>
        <div class="form-group row">
            <div class="col-md-4"></div>
            <div class="col-md-2">
                    <a href="#" id="confirmLabs" class="btn btn-success btn-lg">Confirm</a>
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