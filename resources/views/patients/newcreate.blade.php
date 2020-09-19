<?php
$visits=null;
if(isset($patient)){
$visits=$patient->visits->all();
}else{
$patient=null;
}
?>
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         @if($patient==null)                    
            @include('patients.__create')
        @else
            @include('patients.__show')
        @endif
        @if($visits==null)
            @include('visits.__create')
        @else

        @endif
                </div>
                </div>
</div>
@endsection
