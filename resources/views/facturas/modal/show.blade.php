<div class="modal fade" tabindex="-1" role="dialog" id="showFacturaModal{{$f->factura_id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de la Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>ID de Factura:</strong> {{ $f->factura_id }}</p>
                <p><strong>Fecha de Factura:</strong> {{ $f->fecha_factura }}</p>
                <p><strong>Saldo Pendiente:</strong> {{ $f->saldo_pendiente }}</p>
                <p><strong>ID del Cliente:</strong> {{ $f->cliente->nombre }}</p>
                <p><strong>Concepto:</strong> {{ $f->concepto }}</p>
                {{-- <p><strong>Tipo de Cambio ID:</strong> {{ $f->tipoCambio->valor }}</p> --}}
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
