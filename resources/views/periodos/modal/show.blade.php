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


                <p><strong>ID Período:</strong> {{ $p->periodo_id }}</p>
                <p><strong>Factura:</strong> {{ $p->factura_id }}</p>
                <p><strong>Monto:</strong> {{ $p->monto }}</p>
                <p><strong>Número:</strong> {{ $p->numero }}</p>
                <p><strong>Tipo de Cambio:</strong>
                    @if($p->tipo_cambio == null)
                    <strong class="text-danger">No definido</strong>
                    @else
                        {{$p->tipo_cambio}}
                    @endif
                </p>
                <p><strong>Fecha de Vencimiento:</strong> {{ $p->fecha_vencimiento }}</p>
                <p><strong>Fecha de Pago:</strong>
                    @if($p->fecha_pagado == null)
                    <strong class="text-danger">No definido</strong>
                    @else
                    {{ $p->fecha_pagado }}
                    @endif
                </p>
                <p><strong>Estado:</strong> 
                    @if($p->status == null)
                    <strong class="text-danger">No definido</strong>
                    @else
                    {{ $p->status }}
                    @endif
                </p>
                <p><strong>Área Responsable:</strong> 
                    @if($p->area == null)
                    <strong class="text-danger">No definido</strong>
                    @else
                    {{ $p->area->nombre }}
                    @endif
            </div>
            <div class="modal-footer bg-whitesmoke br justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
