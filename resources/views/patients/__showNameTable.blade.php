<?php
$records=$record;
?>
<table  class="table table-borded table-striped table-responsive">
        <thead>
            <tr>
                <th>
                    Confirm
                </th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Alt Mobile</th>
                <th>Birth Date</th>
            </tr>
        </thead>
        @foreach ($records as $record)
        <tr>
            <td>
                  
                            {!! Form::open([
                                'method' => 'GET',
                                'action' => ['VisitController@create','patient_id'=>$record->id]
                                ]) !!}
                                   {!! Form::hidden('patient_id',$record->id,
                                   [
                                   "class"=>"form-control "
                                   ])
                                   !!}
                                {!! Form::submit('Confirm ', ['class' => 'btn btn-block btn-lg btn-success']) !!}
                                {!! Form::close() !!}
           
            </td>
        <td>{{$record->name}}</td>
        <td>{{$record->mobile_phone_number}}</td>
        <td>{{$record->alternative_phone_number}}</td>
            <td>{{ $record->birth_date }}</td></tr>
        @endforeach
        </table>
        {{ $records->links() }}