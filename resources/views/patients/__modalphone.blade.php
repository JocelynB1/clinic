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
          
    @include('patients.__showNameTable')
              </div>
          </div>
        
      </div>
      <div class="modal-footer">
          <div class="row">
            
                    {!! Form::open([
                        'method' => 'GET',
                        'action' => ['PatientController@searchByPhoneNumber']
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


@section('scripts')
{!!$js!!}  
@endsection