<div class="modal fade" id="ImcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Calcular Nuevo IMC</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                   
                  <form method="POST" action="{{route('imc.guardar')}}" autocomplete="off">
                  @csrf
                  <div class="row">
                <div class="form-group row">
                  
                  <div class="col-sm-3 mb-3 mb-sm-0">
                   @foreach($legajo as $leg)
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{$leg->legajo_id}}"required autofocus id="legajo" readonly>
                  </div>
                  @endforeach
                   <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="input-group">
                    <input type="number" class="form-control form-control-user{{ $errors->has('peso') ? ' is-invalid' : '' }}" name="peso" placeholder="Peso" required autofocus id="peso" >
                    <div class="input-group-prepend">
                      <span class="input-group-text">Kg.</span>
                     </div> 
                    </div>
                  </div>
                   <div class="col-sm-4 mb-3 mb-sm-0">
                     <div class="input-group">
                    <input type="number" class="form-control form-control-user{{ $errors->has('estatura') ? ' is-invalid' : '' }}" name="estatura" placeholder="Estatura" required autofocus id="estatura" title="Ingresar Valores en Centimetros">
                    <div class="input-group-prepend">
                      <span class="input-group-text">CM.</span>
                     </div> 
                  </div>
                  </div>
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

 