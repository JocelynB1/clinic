<?php
if(isset($record)){

}else{
    $record=null;
}
$a=<<<JS
 
 if(document.querySelector("#confirmDelete")){
    document.querySelector("#confirmDelete").addEventListener('click', function (e) {
        $('#delVital').modal('toggle');

        if(document.querySelector("#vital_id"))
        {
            document.querySelector("#vital_id").value=document.querySelector("#id").value;     
        }
         if (e.target != e.currentTarget) {
            e.preventDefault();
        }
        e.stopPropagation();
    }, false);
  } 
JS;
?>
@extends('layouts.app')
@section('content')

@if ($vitals==null)
@include('patients.__modal_delete_vitals')

 <div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
             
                <div class="card-body">       
             
        <div class="container-fluid">
            
                <div class="row">
                   
       
            <div class="card-header"><h1>Vitals for {{$name}} </h1></div>

            <table class="table table-striped table-borded table-hover table-sm table-bordered  table-responsive-sm">
                <thead>
                    <tr>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>

                <tbody>
                   
                    @foreach($records as $record)
                    <tr>
                      
                        <td>
                        {!! Form::open([
                            'method' => 'GET',
                            'action' => ['PatientController@showPatientVitals',$record->patient_id]
                            ]) !!}
                              {!! Form::hidden("vital_id",$record->vital_id)!!}
                              {!! Form::text("id",$record->patient_id,
                              [
                              "placeholder"=>"",
                              "class"=>"form-control",
                              "id"=>"id",
                              "style"=>"display:none"
                              ])
                              !!}
                            {!! Form::submit("Recorded on {$record->created_at->format('d-M-y')}", ['class' => 'btn  btn-lg btn-block btn-info']) !!}
                            {!! Form::close() !!}
                        </td>
                       <td>
                            {!! Form::open([
                                'method' => 'GET',
                                'action' => ['VitalController@edit', $record->vital_id]
                                ]) !!}
                                {!! Form::submit('Edit', ['class' => 'btn btn-lg btn-block btn-success']) !!}
                                {!! Form::close() !!}
                       </td>
                       <td>
                            <button type="button" id="confirmDelete" class="btn btn-lg btn-block btn-danger">Delete</button>
                            
                            
                       </td>
                      
                    
                 
                       
                    </tr>
                    @endforeach
  
                
                 
                </tbody>
                                </table>
            {{$records->links()}} 
          
            
            </div>
                </div>
        </div>
        </div>
    </div>
 </div>
 </div>
 
 @else
            @include('patients.__modal_patient_vitals')
 @endif
@endsection
@section("scripts")
<?php
echo $a;
?>
@endsection

