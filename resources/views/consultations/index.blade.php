<?php
if(isset($record)){

}else{
    $record=null;
}
$patientNames=App\Patient::pluck("name")->toJson();

$a=<<<JS
  
 
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

@extends('layouts.app')
@section('content')
@if ($record==null)
 <div class="container-fluid">
     

<div class="row justify-content-center no-gutters">
    <div class="col-md-12">

        {!! Form::open([
            'method' => 'GET',
                    
            'action'=>'ConsultationController@search'
            ])!!}
            @csrf


   
                <div class="form-row ">
                    {!! Form::label("autocomplete","Enter Name: ",
    ["class"=>"col-md-2 col-form-label text-md-right"])
    !!}
   
                    {!! Form::text("q",null,
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
   

    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
             
                <div class="card-body">       
             
        <div class="container-fluid">
            
                <div class="row">
                   
       
            <div class="card-header"><h1>Patients </h1></div>

            <table class="table table-striped table-borded table-hover table-sm table-bordered  table-responsive-sm">
                <thead>
                    <tr>
                        <th>
                            Patient Name
                        </th>
                      
                        <th>Patient Id</th>
                        <th>Date</th>
                    </tr>
                    </thead>

                <tbody>
                   
                    @foreach($records as $record)
                    <tr>
                      
                        <td>
                        {!! Form::open([
                            'method' => 'GET',
                            'action' => ['ConsultationController@index']
                            ]) !!}
                              {!! Form::hidden("id",$record->patient_id)!!}
                            {!! Form::submit($record['name'], ['class' => 'btn  btn-lg btn-block btn-success']) !!}
                            {!! Form::close() !!}
                        </td>
                       
                      
                    
                        <td><a href="#" style="color: black">{{\App\Patient::find($record->patient_id)->pid}}</a></td>
                        <td><a href="#" style="color: black">{{$record['created_at']}}</a></td>
                       
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
 @include('consultations.__modal')
 @endif
@endsection
@section("scripts")
<?php
echo $a;
?>

@endsection

