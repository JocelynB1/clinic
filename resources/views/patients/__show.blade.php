<?php
unset($keys['updated_at']);
unset($keys[7]);
unset($keys[8]);
foreach ($keys as $key => $value) {
$fieldList[$value]=ucwords(str_replace('_',' ',$value));    
}
$th="<ul class=\"list-group\">";
foreach ($keys as $key => $value) {
    $th.=" <li class=\"list-inline-item\">".ucwords(str_replace('_',' ',$value))."</li>";
}
$td="</ul>";
$name=$record->name ;
$record=$record->toArray();
   
      $td.="<ul class=\"list-group\">";
    foreach ($keys as $key => $value) {
    
    $td.="<li class=\"list-inline-item\">".$record[$value]."</li>";
    }
    $td.='</ul>';

?>

<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">


    <div class="row">
 
        <div class="col-md-7">{!!$th!!}</div>
        <div class="col-md-5">{!!$td!!}</div>

          

    </div>
    </div>


        </div>
    </div>
