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
        <h4 class="modal-title">{{$consultations->created_at->format('d-M-Y')}}</h4>
      </div>
      <div class="modal-body row justify-content-center">
          <div class="col-auto">
            <table class="table table-light table-hover  table-bordered  table-striped table-responsive border-0">
                <tbody> 
                    @include('consultations.__show_consultations_table')
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
          <div class="row">
              <div class="col-md-auto">
                    {!! Form::open([
                        'method' => 'GET',
                        'action' => ['PatientController@showPatientConsultations',$id]

                        ]) !!}
                        {!! Form::submit('Back',
                         [
                             'class' => 'btn btn-default btn-lg btn-block'
                         
                             ]) !!}
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