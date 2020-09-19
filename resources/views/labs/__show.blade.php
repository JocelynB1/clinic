<?php

$record=$labs;
unset($record->pivot);
unset($record->name);
unset($record->created_at);
unset($record->updated_at);
$keys=array_keys($record->toArray());
unset($keys['updated_at']);
unset($keys['id']);
unset($keys['pivot']);
unset($keys[13]);
unset($keys[0]);
unset($keys['created_at']);
foreach ($keys as $key => $value) {
$fieldList[$value]=ucwords(str_replace('_',' ',$value));    
}
$th="<ul class=\"list-group\">";
foreach ($keys as $key => $value) {
    $th.=" <li class=\"list-inline-item\">".ucwords(str_replace('_',' ',$value))."</li>";
}
$td="</ul>";
//$name=$record->name ;
$record=$record->toArray();
unset($keys['name']);

unset($record['pivot']);
   
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
