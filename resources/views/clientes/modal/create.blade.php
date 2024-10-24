<!-- resources/views/clientes/create.blade.php -->
<form action="{{ route('clientes.store') }}" method="POST">
    @csrf

<div class="modal fade" tabindex="-1" role="dialog" id="createClienteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               
                <h5 class="modal-title">Crear nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-group" style="display: none;>
                        <label for="nombre">Id Cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Cliente_ID" name="cliente_id" >
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="nombre">RUC</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="ruc" name="ruc" value="{{ old('ruc') }}">
                        </div>
                        @error('ruc') <!-- Mostrar el mensaje de error para 'ruc' --> 
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle text-danger mr-2"></i>
                            <small>{{ $message }}</small>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required value="{{ old('nombre') }}">
                        </div>
                        @error('nombre') <!-- Mostrar el mensaje de error para 'nombre' -->
 
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle text-danger mr-2"></i>
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Cliente</button>
                    </div>
            </div>
        </div>
    </div>
</div>
</form>