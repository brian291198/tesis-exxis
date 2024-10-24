<form action="{{ route('clientes.update', $c->cliente_id) }}" method="POST" id="clienteForm">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}

    <div class="modal fade" tabindex="-1" role="dialog" id="editClienteModal{{$c->cliente_id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
  

                    <!-- Campo cliente_id -->
                    <div class="form-group">
                        <label for="cliente_id">ID Cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="ID Cliente" name="cliente_id" value="{{ old('cliente_id', $c->cliente_id) }}" readonly>
                        </div>
                    </div>

                    <!-- Campo RUC -->
                    <div class="form-group">
                        <label for="ruc">RUC</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="RUC" name="u_ruc" value="{{ old('u_ruc', $c->ruc) }}">
                        </div>
                        @error('u_ruc')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo Nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre" name="u_nombre" required value="{{ old('u_nombre', $c->nombre) }}">
                        </div>
                        @error('u_nombre')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                </div>
            </div>
        </div>
    </div>
</form>
