
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


$a=<<<JS
  
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


JS;


?>
 <div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>All Labs</h1></div>

                <div class="card-body">       
             
        <div class="container-fluid">
            
                <div class="row">
                    <div class="col-auto">
            
                        {!! Form::open([
                        'method' => 'GET',
                        'class'=>"form-inline",                  
                        'action'=>'LabController@index'
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
            
                        <a href="{{action('LabController@index')}}">Reset</a>
                    </div>
                    <div class="col-auto text-right">
                        <a href="{{action('LabController@index',['created_at'=>request('created_at'),'sort'=>'asc'])}}">Ascending</a>
                        <a href="{{action('LabController@index',['created_at'=>request('created_at'),'sort'=>'desc'])}}">Descending</a>
                    </div>
                </div>
            
                <table class="table table-striped table-borded table-hover table-sm table-bordered  table-responsive-sm">
                    <thead>
                        <tr>
                      <th>Delete</th>
                            <th>View</th>
                            <th>Edit</th>

                            {!!$th!!}
                        </tr>
                        </thead>

                    <tbody>
                       
                        @foreach($records as $record)
                        <tr>
                            <td>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'action' => ['LabController@destroy', $record->id]
                                ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>
                            {!! Form::open([
                                'method' => 'GET',
                                'action' => ['LabController@show', $record->id]
                                ]) !!}
                                {!! Form::submit('View', ['class' => 'btn btn-info']) !!}
                                {!! Form::close() !!}
                            </td>
                              <td>
                            {!! Form::open([
                                'method' => 'GET',
                                'action' => ['LabController@edit', $record->id]
                                ]) !!}
                                {!! Form::submit('Edit', ['class' => 'btn btn-success']) !!}
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

