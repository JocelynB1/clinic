
@extends('layouts.app')
@section('content')

 <div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-6">
            <div class="row">
                <div style="width:75%;">
                <h4>Patient Attendance By Date</h4>

                        {!! $pieChartjs->render() !!}
                    </div>
                    <div class="row">
                <h4>Patient Attendance By Date</h4>

                            <div style="width:75%;">
                                    {!! $barChartjs->render() !!}
                                </div>
                    </div>
            </div>
            <div class="row">
                <h4>Gender of Patients Who Visited Within Given Period In Percentages</h4>
                    <div style="width:75%;">
                        {!! $genderPieChartjs->render() !!}
                    </div>

                    <div class="row">
                            <div style="width:75%;">
                <h4>Number of Patients By Gender Who Visited Within Given Period</h4>

                                    {!! $genderBarChartjs->render() !!}
                                </div>
                    </div>
                </div>
        </div>
        <div class="col-md-6">
         
        <div class="card">
                <div class="card-header"><h1>Patients Per Period</h1></div>

                <div class="card-body">       
             
        <div class="container-fluid">
            
                <div class="row">
                    <div class="col-auto">
            
                        {!! Form::open([
                        'method' => 'GET',
                        'class'=>"form-inline",                  
                        'action'=>'ReportController@getPatientsPerPeriod'
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
                        <a href="{{action('ReportController@getPatientsPerPeriod',[
                            'sort'=>'asc',
                            'dateQuery'=>$startDate,
                            'dateQueryEnd'=>$endDate
                            ])}}">Ascending</a>
                        <a href="{{action('ReportController@getPatientsPerPeriod',[
                            'sort'=>'desc',
                            'dateQuery'=>$startDate,
                            'dateQueryEnd'=>$endDate
                            ])}}">Descending</a>
                    </div>
                </div>
            <br>
            <div class="col-md-12">
                <table class="table table-striped table-borded table-hover table-sm table-bordered  table-responsive-sm">
                    <thead>
                        <tr>
                    
                            <th>View Details</th>
                            <th>Name</th>
                           <th>Date Of Last Visit</th>
                        </tr>
                        </thead>

                    <tbody>
                       
                        @foreach($records as $record)
                        <?php
                        $pid=App\Patient::find($record->patient_id)->pid;
                        $name=App\Patient::find($record->patient_id)->name;
                        ?>
                        <tr>
                         
                            <td>
                            {!! Form::open([
                                'method' => 'GET',
                                'action' => ['ReportController@showPatientDetails', $record->patient_id]
                                ]) !!}
                                {!! Form::hidden("id",$record->patient_id)!!}
                                {!! Form::submit($pid, ['class' => 'btn btn-info']) !!}
                                {!! Form::close() !!}
                            </td>
                        
                        <td>
                            {{$name}}
                        </td>
                        <td>
                            {{$record->created_at}}
                        </td>
                        </tr>
                        @endforeach
      
                    
                     
                    </tbody>
                                    </table>
                                    
                                    <hr> <h2><b> Total :</b> {{$total}}</h2>
                                    {{$records->appends($_GET)->links()}}
            </div>
                </div>
        </div>
        </div>
    </div>
 </div>
</div>
@endsection
