
@extends('layouts.app')
@section('content')

 <div class="container-fluid">
    <div class="row justify-content-center no-gutters">
       
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>Patients By Risk Factor</h1></div>

                <div class="card-body">       
             
        <div class="container-fluid">
            
                <div class="row">
                    <div class="col-auto">
            
                        {!! Form::open([
                        'method' => 'GET',
                        'class'=>"form-inline",                  
                        'action'=>'ReportController@getPatientsByRiskFactor'
                        ])!!}
                        @csrf
            
            
                        <div class="form-row align-items-center">
                         
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
            
            
                            <div class="col-md-auto">
                                {!! Form::submit('Submit ', ['class' => 'btn btn-primary btn-lg ']) !!}
                        </div>
                        </div>
            
            
            
                        {!! Form::close() !!}
            
                     
                    </div>
                    <div class="col-auto text-right">
                        <a href="{{action('ReportController@getPatientsByRiskFactor',[
                            'sort'=>'asc',
                            'dateQuery'=>$startDate,
                            'dateQueryEnd'=>$endDate
                            ])}}">Ascending</a>
                        <a href="{{action('ReportController@getPatientsByRiskFactor',[
                            'sort'=>'desc',
                            'dateQuery'=>$startDate,
                            'dateQueryEnd'=>$endDate
                            ])}}">Descending</a>
                    </div>
                </div>
            <br>
           
                </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <div class="row">
                <div style="width:75%;">
                        {!! $pieChartjs->render() !!}
                    </div>
            </div>
                    <div class="row">
                            <div style="width:75%;">
                                    {!! $barChartjs->render() !!}
                                </div>
                    </div>
                    <div class="row">
                            <div style="width:75%;">
                                    {!! $lineGraphChartjs->render() !!}
                                </div>
                    </div>

    </div>
    <div class="col-md-6">
            <div class="row">
                    <table class="table table-striped table-borded table-hover table-sm table-bordered  table-responsive-sm">
                            <thead>
                                <tr>
                            
                                    <th>FRS score</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
        
                            <tbody>
                               
                                @foreach($records as $record)
                                <tr>
                               
                                    <td>
                                             {{key($record)}}
                                    </td>
                                
                                <td>
                               {{$record[(string)key($record)]}}
                                     </td>
                                </tr>
                                @endforeach
              
                            
                             
                            </tbody>
                                            </table>
            </div>
        </div>
    
</div>
 </div>
</div>
@endsection
