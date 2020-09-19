
@extends('layouts.app')
@section('content')
<?php
unset($keys['updated_at']);
unset($keys['id']);
$fieldList=array();
foreach ($keys as $key => $value) {
$fieldList[$value]=ucwords(str_replace('_',' ',$value));    
}
$th="";
foreach ($keys as $key => $value) {
    $th.="<th>".ucwords(str_replace('_',' ',$value))."</th>";
}
$td="";
$arrRecords=$records->toArray();
    foreach ($records as $rkey => $record) {
      $td.='<tr>';
    foreach ($keys as $key => $value) {
    
    $td.="<td><a href=\"#\" style=\"color: black\">".$record[$value]."</a></td>";
    }
    $td.='</tr>';
}

$patientNames=App\Patient::pluck("name")->toJson();

$a=<<<JS
  
  if(document.querySelector("#confirmDelete")){
    document.querySelector("#confirmDelete").addEventListener('click', function (e) {
        $('#delPatient').modal('toggle');
        if(document.querySelector("#patient_id"))
        {
            document.querySelector("#patient_id").value=document.querySelector("#id").value;     
        }

        if (e.target != e.currentTarget) {
            e.preventDefault();
        }
        e.stopPropagation();
    }, false);
  }
if (document.querySelector("#dateQuery")) {

    var dateQueryEnd = document.querySelector("#dateQueryEnd");
    var dateQuery = document.querySelector("#dateQuery");
    dateQueryEnd.disabled = true;
    dateQuery.disabled = true;


    document.querySelector("#dateQueryDiv").style.display = "none";
    document.querySelector("#dateQueryEndDiv").style.display = "none";

    var field = document.querySelector("#field");

    var textQuery = document.querySelector("#query");

    field.addEventListener('change', function (e) {
        switch (field.value) {
      
            case "created_at":
                switchToDateQueryInputs();
                break;

            case "updated_at":
                switchToDateQueryInputs();
                break;

      
            default:
            switchToTextQueryInputs();
                break;
        }

        if (e.target != e.currentTarget) {
            e.preventDefault();
        }
        e.stopPropagation();
    }, false);
}
function switchToDateQueryInputs() {
    textQuery.style.display = "none";
    textQuery.disabled = true;
    dateQuery.disabled = false;
    dateQueryEnd.disabled = false;
    dateQuery.style.display = "block";
    dateQueryEnd.style.display = "block";
    document.querySelector("#dateQueryEndDiv").style.display = "block";
    document.querySelector("#dateQueryDiv").style.display = "block";
}
function switchToTextQueryInputs() {
    textQuery.style.display = "block";
    textQuery.disabled = false;
    dateQuery.disabled = true;
    dateQueryEnd.disabled = true;
    dateQuery.style.display = "none";
    dateQueryEnd.style.display = "none";
    document.querySelector("#dateQueryDiv").style.display = "none";
    document.querySelector("#dateQueryEndDiv").style.display = "none";

}

( function( $, undefined ) {
$.widget( "ab.autocomplete", $.ui.autocomplete, {
inputClasses: "ui-widget ui-widget-content ui-corner-all",
_create: function() {
this._super( "_create" );
this._focusable( this.element );
this.element.addClass( this.inputClasses );
},
_destroy: function() {
this._super( "_destroy" );
this.element.removeClass( this.inputClasses );
}
});
})( jQuery );
$( function() {
var source =$patientNames;
$( "#autocomplete" ).autocomplete( { source: source } );
});

JS;


?>
@include('patients.__modal_delete_patients')

 <div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>All Patients</h1></div>

                <div class="card-body">       
             
        <div class="container-fluid">
            <?php
            /*
                <div class="row">
                    <div class="col-auto">
            
                        {!! Form::open([
                        'method' => 'GET',
                        'class'=>"form-inline",                  
                        'action'=>'PatientController@index'
                        ])!!}
                        @csrf
            
            
                        <div class="form-row align-items-center">
                            {!! Form::label('field','Filter:',['class'=>
                            'col-auto col-form-label']) !!}
                            <div class="col-auto">
                                {!!Form::select('field',$fieldList ,null, ['class' => 'form-control'])!!}
                            </div>
                            {!! Form::label('query','Query:',['class'=>
                            'col-auto col-form-label']) !!}
                            <div class="col-auto" id="textQueryDiv">
                                {!! Form::text('query',null,['class'=> 'form-control',"id"=>"query"]) !!}
                            </div>
                            <div class="col-auto" id="dateQueryDiv" style="display:none">
                                {!! Form::date('dateQuery',null,['class'=> 'form-control', "id"=>"dateQuery"]) !!}
                            </div>
                            <div class="col-auto" id="dateQueryEndDiv" style="display:none">
                                {!! Form::date('dateQueryEnd',null,['class'=> 'form-control', "id"=>"dateQueryEnd"]) !!}
                            </div>
            
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
            
            
            
                        {!! Form::close() !!}
            
                        <a href="{{action('PatientController@index')}}">Reset</a>
                    </div>
                    <div class="col-auto text-right">
                        <a href="{{action('PatientController@index',['created_at'=>request('created_at'),'sort'=>'asc'])}}">Ascending</a>
                        <a href="{{action('PatientController@index',['created_at'=>request('created_at'),'sort'=>'desc'])}}">Descending</a>
                    </div>
                </div>
            */?>
            <div class="row justify-content-center no-gutters">
        <div class="col-md-12">

            {!! Form::open([
                'method' => 'GET',
                        
                'action'=>'PatientController@index'
                ])!!}
                @csrf
    
    
       
                    <div class="form-row ">
                        {!! Form::label("autocomplete","Enter Name: ",
        ["class"=>"col-md-2 col-form-label text-md-right"])
        !!}
       
                        {!! Form::text("name",null,
                        [
                        "placeholder"=>"",
                        "class"=>"form-control col-md-6",
                        "id"=>"autocomplete",
                        "style"=>"margin:10px;"
                        ])
                        !!}
   
 
   {!! Form::submit('Search', ['class' => 'btn btn-lg btn-primary col-md-1']) !!}
                        
                      
                        </div>
                        {!! Form::close() !!}
                        <br> 
        </div>
            </div>
                <table class="table table-striped table-borded table-hover table-sm table-bordered  table-responsive-sm">
                    <thead>
                        <tr>
                      <th>Delete</th>
                      <th>View</th>
                      <th>View Patient Folder</th>
                            <th>Edit</th>

                            {!!$th!!}
                        </tr>
                        </thead>

                    <tbody>
                       
                        @foreach($records as $record)
                        <tr>
                            <td>
                                    <button type="button" id="confirmDelete" class="btn btn-lg btn-danger">Delete</button>

                     
                            </td>
                            <td>
                          {!! Form::open([
                                'method' => 'GET',
                                'action' => ['PatientController@show', $record->id]
                                ]) !!}
                                   {!! Form::text("id",$record->id,
                                   [
                                   "placeholder"=>"",
                                   "class"=>"form-control",
                                   "id"=>"id",
                                   "style"=>"display:none"
                                   ])
                                   !!}
                                
                                {!! Form::submit('View', ['class' => 'btn btn-lg btn-info']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open([
                                          'method' => 'GET',
                                          'action' => ['PatientController@showAllPatientData', $record->id]
                                          ]) !!}
                                             {!! Form::text("id",$record->id,
                                             [
                                             "placeholder"=>"",
                                             "class"=>"form-control",
                                             "id"=>"id",
                                             "style"=>"display:none"
                                             ])
                                             !!}
                                          
                                          {!! Form::submit('View Patient Folder', ['class' => 'btn btn-lg btn-secondary']) !!}
                                          {!! Form::close() !!}
                                      </td>
                              <td>
                            {!! Form::open([
                                'method' => 'GET',
                                'action' => ['PatientController@edit', $record->id]
                                ]) !!}
                                {!! Form::submit('Edit', ['class' => 'btn btn-lg btn-success']) !!}
                                {!! Form::close() !!}
                            </td>
                           @foreach($keys as $key)
                            <td><a href="#" style="color: black">{{$record[$key]}}</a></td>
                            @endforeach
                        </tr>
                        @endforeach
      
                    
                     
                    </tbody>
                                    </table>
                {{$records->appends($_GET)->links()}}
            </div>
                </div>
        </div>
        </div>
    </div>
 </div>
@endsection
@section("scripts")
<?php
echo $a;
?>
@endsection

