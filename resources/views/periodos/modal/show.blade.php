<div class="modal fade" tabindex="-1" role="dialog" id="showPeriodoModal{{$p->periodo_id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Período</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>ID del Período:</strong> {{ $p->periodo_id }}</p>
                <p><strong>Fecha de Vencimiento:</strong> {{ $p->fecha_vencimiento }}</p>
                <p><strong>ID del Área:</strong> {{ $p->area_id }}</p>
                <p><strong>Estado:</strong> {{ $p->status }}</p>
                <p><strong>ID de Factura:</strong> {{ $p->factura_id }}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
