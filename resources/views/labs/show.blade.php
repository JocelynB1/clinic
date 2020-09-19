<?php
unset($keys['updated_at']);
unset($keys['id']);
foreach ($keys as $key => $value) {
$fieldList[$value]=ucwords(str_replace('_',' ',$value));    
}
$th="<ul class=\"list-group\">";
foreach ($keys as $key => $value) {
    $th.=" <li class=\"list-group-item\"><h4>".ucwords(str_replace('_',' ',$value))."</h4></li>";
}
$td="</ul>";
$name=$record->name ;
$record=$record->toArray();
   
      $td.='<ul class="list-group">';
    foreach ($keys as $key => $value) {
    
    $td.="<li class=\"list-group-item\"><h4>".$record[$value]."</h4></li>";
    }
    $td.='</ul>';

?>
@extends('layouts.app')



@section('content')
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>Lab  Results</h1></div>

                <div class="card-body">
                    

    <div class="row">
 
        <div class="col-md-6">{!!$th!!}</div>
        <div class="col-md-6">{!!$td!!}</div>

          

    </div>
    </div>


        </div>
    </div>
</div>
    </div>

@endsection