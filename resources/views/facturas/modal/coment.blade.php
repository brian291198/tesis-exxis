<form action="{{ route('facturas.store') }}" method="POST">
    @csrf

    <div class="modal fade" tabindex="-1" role="dialog" id="comentFacturaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Realizar comentario rápido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">




                    <div class="form-group">
                        <label for="factura_id">ID de Factura</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="ID de Factura" name="factura_id" required>
                        </div>
                        @error('factura_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>




                    
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>