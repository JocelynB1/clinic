

<!-- Modal -->
<div class="modal fade" id="delLab" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Are you sure you want to delete this record?</h4>
            </div>
            <div class="modal-body row justify-content-center">
                <div class="col-auto">
                  <table class="table table-light table-hover  table-bordered  table-striped table-responsive border-0">
                    
                  </table>
              </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                      <div class="col-md-6">
                          {!! link_to(URL::previous(),'Back',[
                              'class' => 'btn btn-default btn-lg btn-block'
                          
                              ])!!}
                                  </div>
                        <div class="col-md-6">
                          
                              {!! Form::open([
                                  'method' => 'DELETE',
                                  'action' => ['LabController@destroy',1]
                                  ]) !!}
                                  {!! Form::text("lab_id",null,
                                  [
                                  "placeholder"=>"",
                                  "class"=>"form-control",
                                  "id"=>"lab_id",
                                  "style"=>"display:none"
                                  ])
                                  !!}
                                  {!! Form::submit('Delete', ['class' => 'btn btn-lg btn-block btn-danger']) !!}
                                  {!! Form::close() !!} 
                        </div>
                             
                    </div>
                
                </div>
         
            </div>
          </div>
        </div>
      </div>
      