<form action="{{ route('areas.store') }}" method="POST">
    @csrf

    <div class="modal fade" tabindex="-1" role="dialog" id="createAreaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nueva Área</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre del Área</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-th"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre del Área" name="nombre" required>
                        </div>
                        @error('nombre')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Área</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
