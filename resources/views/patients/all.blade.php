<?php
$visits=null;
if(isset($patient)){
$allVisits=$patient->visits->all();
$allVitals=$patient->vitals->all();
$vitals=null;
$allLabs=$patient->labs->all();
$consultationLength=count($patient->consultations->all());
$allConsultations=$patient->consultations->all();
}else{
$patient=null;
}
?>
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">   
        <div class="col-md-12">
                <div class="table-responsive">
<div class="row">
    {!! Form::open([
        'method' => 'GET',
        'action' => ['PatientController@export',$patient->id]
        ]) !!}
        
        {!! Form::submit('Export', ['class' => 'btn btn-lg btn-info']) !!}
        {!! Form::close() !!}
</div>
            @if($patient==null)                    
                @else
                <table class="table table-hover table-bordered table-xl table-striped">
                <h1>Biographical Data For {{$patient->name}}</h1>
                <hr>
                    <tbody>
                        @include('patients.__show_patients_table')  
                    </tbody>
                </table>
            @endif
              
            @foreach ($allVisits as $visits)
                <table class="table table-hover table-bordered table-xl table-striped">
                    <h1>Medical History as of {{$visits->created_at->format("d-m-y")}}</h1>
                    <tbody>
                        @include('visits.__show_visits_table_all')
                    </tbody>
                </table>
            @endforeach

            @foreach($allVitals as $vitals)
                <table class="table table-hover  table-bordered table-xl table-striped">
                    <h1>Vitals Recorded on {{$vitals->created_at->format("d-m-y")}}</h1>
                    <tbody>
                         @include('vitals.__show_vitals_all')
                    </tbody>
                </table>
            @endforeach
      
            @foreach ($allLabs as $labs)
                <table class="table table-hover  table-bordered table-xl table-striped">
                    <h1>Test Results Recorded on {{$labs->created_at->format("d-m-y")}}</h1>
                    <tbody>
                            @include('labs.__show_labs_table_all')
                    </tbody>
                </table>                    
            @endforeach

            @foreach ($allConsultations as $consultations)
            <table class="table table-hover  table-bordered table-xl table-striped">
                <h1>Consulted on {{$consultations->created_at->format("d-m-y")}}</h1>
                <tbody>
                        @include('consultations.__show_consultations_table_all')
                </tbody>
            </table>                    
        @endforeach

            </div>                  
        </div>
    </div>

</div>

@endsection
