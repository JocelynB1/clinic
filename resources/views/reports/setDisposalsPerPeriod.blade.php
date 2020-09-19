<?php
if(isset($record)){

}else{
    $record=null;
}

?>
@extends('layouts.app')



@section('content')
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card border-0">
              
            <div class="container-fluid">
                <br>
              
                {!! Form::open([
                    'method' => 'POST',
                    'class'=>"form-group",                  
                    'action'=>['ReportController@getDisposalsPerPeriod']
                    ])!!}
                                            @csrf

                    <div class="row">
                          
                            <div class="col-md-4"></div>
                           
                                <div class="form-group row ">
                                       
                                
                                
                                   <div class="col-md-auto">
                                        {!! Form::label('dateQuery','Start:',['class'=>
                                        ' col-form-label']) !!}
                                   </div>
                                    <div class="col-md-auto" id="dateQueryDiv">
                                        {!! Form::date('dateQuery',$startDate,['class'=> 'form-control', "id"=>"dateQuery"]) !!}
                                    </div>
                                    <div class="col-md-auto">
                                            {!! Form::label('dateQueryEndDiv','End:',['class'=>
                                            ' col-form-label']) !!}
                                       </div>
                                    <div class="col-md-auto" id="dateQueryEndDiv">
                                        {!! Form::date('dateQueryEnd',$endDate,['class'=> 'form-control', "id"=>"dateQueryEnd"]) !!}
                                    </div>
                    
                         
                            </div>
                                                 

                        </div>
                        <br>
                        <div class="form-group row">
                                <div class="col-md-6"></div>
                                <div class="col-md-auto">
                                        {!! Form::submit('Submit ', ['class' => 'btn btn-primary btn-lg ']) !!}
                                </div>
                        </div>

                        {!! Form::close() !!}
                
            
               
        </div>

</div>
</div>
</div>
@endsection
