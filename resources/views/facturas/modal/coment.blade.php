<form action="{{ route('facturas.coment') }}" method="POST">
    @csrf

    <div class="modal fade" tabindex="-1" role="dialog" id="comentFacturaModal{{$f->factura_id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Realizar comentario rápido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Mostrar la factura_id -->
                    <div class="form-group">
                        <label for="factura_id">Factura ID:</label>
                        <input type="text" id="factura_id" name="factura_id" class="form-control" readonly value="{{ $f->factura_id ?? '' }}" readonly>
                    </div>

                    <!-- Textarea para el comentario -->
                    <div class="form-group">
                        <label for="description">Comentario:</label>
                        <textarea id="description" name="description" class="form-control" rows="8" placeholder="Escribe tu comentario aquí..." style="height: 150px !important;"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
