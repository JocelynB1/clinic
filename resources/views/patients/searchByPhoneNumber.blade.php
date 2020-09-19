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
         
        <div class="card">
              

                    @if ($record==null)
                <div class="card-header"><h1>Patient Details</h1></div>

                    <div class="container">
                            {!! Form::open([
                                'method' => 'POST',
                              'action' => 'PatientController@search']) !!}
               <br>
               <br>
               <br>
                          <div class="row">
                              <div class="col-md-2"></div>
                              <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile_phone_number"
                                        placeholder="Search by Phone Number"> <span class="input-group-btn">
                                        
                                    </span>
                                </div>
                            </div>
                              <div class="col-md-2"></div>

                            </div>
                   <br>
                   <br>
                            <div class="form-group row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                            {!! Form::submit('Submit ', ['class' => 'btn btn-lg btn-primary']) !!}
                                    </div>
                            </div>
    
                            {!! Form::close() !!}
                        </div>
                    @else
                        @include('patients.__modalphone')
                    @endif
        
                </div>
                </div>
</div>
</div>
@endsection
