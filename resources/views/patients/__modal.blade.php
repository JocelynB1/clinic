<?php
$js=<<<JS
$('#patient').modal('toggle');
JS;
?>

<!-- Modal -->
<div class="modal fade" id="patient" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          <div class="modal-body row justify-content-center">
              <div class="col-auto">
        
    @include('patients.__showtable')
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <div class="row">
              <div class="col-md-6">
                    {!! Form::open([
                        'method' => 'GET',
                        'action' => ['PatientController@createPrevious']
                        ]) !!}
                        {!! Form::submit('Back',
                         [
                             'class' => 'btn btn-default btn-lg btn-block'
                         
                             ]) !!}
                        {!! Form::close() !!}
              </div>
              <div class="col-md-6">
                    {!! Form::open([
                        'method' => 'GET',
                        'action' => ['VisitController@create']
                        ]) !!}
                        {!! Form::hidden('patient_id',$record->id,
                        [
                        "class"=>"form-control "
                        ])
                        !!}
                        {!! Form::submit('Confirm ', ['class' => 'btn btn-block btn-lg btn-success']) !!}
                        {!! Form::close() !!}
              </div>
          </div>
   
      </div>
    </div>
  </div>
</div>

@section('scripts')
{!!$js!!}  
@endsection