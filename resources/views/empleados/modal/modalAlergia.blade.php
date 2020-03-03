{{-- Modal --}}
        <div class="modal fade" id="AlergiaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Editar Alergia</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                  @foreach($Empleados as $empleado)
                  <form  class="user" method="POST" action="{{ route('alergia.update',$empleado->legajo)}}" autocomplete="off">
                  {{method_field('PUT')}}
                  @csrf                
                  <input type="hidden" id="alergiaId" name="alergiaId">
                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                       <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{ old('legajo') }}" id="alergiaLegajo" readonly>
                              @if ($errors->has('legajo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo') }}</strong>
                                    </span>
                              @endif
                        </div>
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo" value="{{ old('tipo') }}" id="alergiaTipo">
                              @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                              @endif
                  </div>
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('observacion') ? ' is-invalid' : '' }}" name="observacion" value="{{ old('observacion') }}" id="alergiaObservacion">
                              @if ($errors->has('observacion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('observacion') }}</strong>
                                    </span>
                              @endif
                  </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    @endforeach
                  </form>
                </div>
                </div>
                  </div>
                  </div>