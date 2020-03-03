{{-- Modal --}}

        <div class="modal fade" id="DietaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Editar Dieta</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                  @foreach($Empleados as $empleado)
                  <form  class="user" method="POST" action="{{ route('dieta.update',$empleado->legajo)}}" autocomplete="off">
                  {{method_field('PUT')}}
                  @csrf                
                  <input type="hidden" id="dietaId" name="dietaId">
                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                       <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{ old('legajo') }}" id="dietaLegajo" readonly>
                        </div>
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('tipo_1') ? ' is-invalid' : '' }}" name="tipo_1" value="{{ old('tipo_1') }}" id="dietaTipo">
                  </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('tipo_2') ? ' is-invalid' : '' }}" name="tipo_2" value="{{ old('tipo_2') }}" id="dietaTipo2">
                  </div>
                  </div>

                  <div class="form-group row">
                     <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('comidas_permitidas') ? ' is-invalid' : '' }}" name="comidas_permitidas" value="{{ old('comidas_permitidas') }}" id="dietacomidas_permitidas">
                  </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('comidas_no_permitidas') ? ' is-invalid' : '' }}" name="comidas_no_permitidas" value="{{ old('comidas_no_permitidas') }}" id="dietacomidas_no_permitidas">
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