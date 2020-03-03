<div class="modal fade" id="VacunacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Agregar Vacuna</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
	                <div class="modal-body">

	               <form  class="user" method="POST" action="{{route('programaVacunacion.cargarVacunaPrograma')}}" autocomplete="off">
             
                  @csrf                
                  <input type="hidden" id="empleadoId" name="empleadoId">
                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                       <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="" id="legajo" readonly>
                              @if ($errors->has('legajo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo') }}</strong>
                                    </span>
                              @endif
                        </div>
                  </div>
                   <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('fecha') ? ' is-invalid' : '' }}" name="fecha" value="" id="fecha" readonly>
                              @if ($errors->has('fecha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                              @endif
                  </div>
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('vacuna') ? ' is-invalid' : '' }}" name="vacuna" value="" id="vacuna" readonly>
                              @if ($errors->has('vacuna'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vacuna') }}</strong>
                                    </span>
                              @endif
                  </div>
                  </div>
                   <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('dosis') ? ' is-invalid' : '' }}" name="dosis" value="" id="dosis" readonly>
                              @if ($errors->has('dosis'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dosis') }}</strong>
                                    </span>
                              @endif
                  </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="hidden" class="form-control form-control-user{{ $errors->has('numero') ? ' is-invalid' : '' }}" name="numero" value="" id="numero" readonly>
                              @if ($errors->has('numero'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
                              @endif
                  </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                   
                  </form>
	                </div>
                </div>
            
            </div>
</div>