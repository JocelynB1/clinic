
@extends('layouts.app')
@section('content')

 <div class="container-fluid">
    <div class="row justify-content-center no-gutters">
   
        <div class="col-md-12">
         
        <div class="card">
                <div class="card-header"><h1>Patients </h1></div>

                <div class="card-body">       
             
        <div class="container-fluid">
            
                <div class="row">
               
                    <div class="col-auto text-right">
                        <a href="{{action('ReportController@getPatientsWhoHaveNotAttendedForSixMonths',[
                            'sort'=>'asc'
                            ])}}">Ascending</a>
                        <a href="{{action('ReportController@getPatientsWhoHaveNotAttendedForSixMonths',[
                            'sort'=>'desc'
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
                            <th>Patient ID</th>
                            <th>Mobile Phone Number</th>
                            <th>Alternate Phone Number</th>
                           <th>Date Of Last Visit</th>
                           <th>Last Comment</th>
                        </tr>
                        </thead>

                    <tbody>
                       
                        @foreach($records as $record)
                        <?php
                        $consultation=App\ConsultationPatient::where("consultation_id",$record->id)->get()->last();
                        $pid=$consultation->patient_id;
                        $patient=App\Patient::find($pid);

                        $name=App\Patient::find($pid)->name;
                        ?>
                        <tr>
                        <td>
                                {!! Form::open([
                                    'method' => 'GET',
                                    'action' => ['PatientController@showAllPatientData', $pid]
                                    ]) !!}
                                       {!! Form::text("id",$pid,
                                       [
                                       "placeholder"=>"",
                                       "class"=>"form-control",
                                       "id"=>"id",
                                       "style"=>"display:none"
                                       ])
                                       !!}
                                    
                                    {!! Form::submit('View Patient Folder', ['class' => 'btn btn-lg btn-secondary']) !!}
                                    {!! Form::close() !!}
                                </td>
                        <td>
                            {{$name}}
                        </td>
                        <td>
                        {{$patient->pid}}
                        </td>
                        <td>
                            {{$patient->mobile_phone_number}}
                        </td>
                        <td>
                            {{$patient->alternative_phone_number}}
                        </td>
                        <td>
                            {{$record->created_at}}
                        </td>
                        <td>
                            {{$record->comment}}

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
    <div class="col-md-6">
            <div class="row"></div>
                <div style="width:75%;">
                        {!! $pieChartjs->render() !!}
                    </div>

                    <div class="row">
                            <div style="width:75%;">
                                    {!! $barChartjs->render() !!}
                                </div>
                    </div>
                
        </div>
 </div>
</div>
@endsection
