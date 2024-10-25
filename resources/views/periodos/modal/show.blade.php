<div class="modal fade" tabindex="-1" role="dialog" id="showPeriodoModal{{$p->periodo_id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-whitesmoke">
            <div class="modal-header">
                {{-- <h5 class="modal-title">Detalles del Período</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <div class="row">
                    <div class="col-12 col-md-7">

                        <h3 class="mb-3 text-center">Detalles de la Cuota</h6>
      
                        <div class="card">
                            
                            <div class="card-body">

                                <p><strong>ID Período:</strong> {{ $p->periodo_id }}</p>
                                <p><strong>Factura:</strong> {{ $p->factura_id }}</p>
                                <p><strong>Cliente:</strong> {{ $p->factura->cliente->nombre }}</p>
                                <p><strong>Monto:</strong> {{ $p->monto }}</p>
                                <p><strong>Número de cuota:</strong> {{ $p->numero }}</p>
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
                        </div>
                    </div>
                    <div class="col-12 col-md-5"> 
                        
                        <h5 class="mb-4 text-center">Comentarios de la Cuota</h5>
                        
                            @foreach ($p->comentarios as $comentario)
                            <div class="col-12 mb-3">
                               
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="card-title mb-1">{{ $comentario->usuario }}</h6>
                                            <small class="text-muted">{{ $comentario->fecha}}</small>
                                        </div>
                                        <p class="card-text">{{ $comentario->description }}</p>
                                    </div>
                                </div>
                              
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
                            <button class="btn btn-success btn-sm m-auto" type="button" data-toggle="modal" data-target="#comentPeriodoModal{{$p->periodo_id}}">
                                <i class="fas fa-comment mr-2"></i> Registrar nuevo comentario
                            </button>
                            </div>
                    </div>



                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
