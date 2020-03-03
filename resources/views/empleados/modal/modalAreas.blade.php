 <div class="modal fade" id="nuevaArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Agregar Area</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                  <form class="user" method="POST" action="{{ route('empleado.guardarArea')}}" autocomplete="off">
                    @csrf
                  <div class="form-group row">

                    <div class="col-sm-5 mb-3 mb-sm-0">
                    
                      <input type="text" class="form-control form-control-user{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="nombre" placeholder="Nombre">
                              @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                              @endif
                    </div>
                  </div>
                  <div class="form-group row">

                    <div class="col-sm-5 mb-3 mb-sm-0">
                      
                      <input type="text" class="form-control form-control-user{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" id="telefono" placeholder="Telefono(opcional)">
                              @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                              @endif
                    </div>
                  </div>
                
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                    </div>
                    
                  </form>
                </div>
                </div>
            </div>
</div>
