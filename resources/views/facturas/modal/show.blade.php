<div class="modal fade" tabindex="-1" role="dialog" id="showFacturaModal{{$f->factura_id}}">
    <div class="modal-dialog modal-lg" role="document"> <!-- Modal más grande -->
        <div class="modal-content bg-whitesmoke">
            <div class="modal-header">
                
                {{-- <h3 class="modal-title">Información</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
 
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;"> <!-- Scroll en el cuerpo del modal -->
                
                <div class="row">
                    <div class="col-12 col-md-7">

                        <h3 class="mb-3 text-center">Detalles de la factura</h6>
      
                        <div class="card">
                            
                            <div class="card-body">
                            <p><strong>ID de Factura:</strong> {{ $f->factura_id }}</p>
                            <p><strong>Fecha de Factura:</strong> {{ $f->fecha_factura }}</p>
                            <p><strong>Cantidad de Cuotas:</strong> {{ $f->num_cuotas }}</p>
                            <p><strong>Saldo Pendiente:</strong> {{ $f->saldo_pendiente }}</p>
                            <p><strong>Nombre del Cliente:</strong> {{ $f->cliente->nombre }}</p>
                            <p><strong>Concepto:</strong> 
                                @if ($f->concepto == null)
                                <strong class="text-danger">No definido</strong>
                                @else
                                {{$f->tipo_cambio}}
                                @endif
                            </p>
                            <p><strong>Tipo:</strong> 
                                @if ($f->tipo_cambio  == null)
                                <strong class="text-danger">No definido</strong>
                                @else
                                {{$f->tipo_cambio}}
                                @endif
                            </p>
                            <p><strong>Carta Notarial:</strong> 
                                @if ($f->cartanotarial == 1)
                                <strong class="text-danger">En proceso</strong>
                                @else
                                <strong class="text-success">No tiene</strong>
                                @endif
                            </p>
                            </div>
                        </div>
                            <div class="card">
                                <div class="card-header text-center">
                                <h5 class="mt-2 text-center">Cuotas de la Factura</h5>
                                </div>
                                <div class="">
                                <!-- Tabla de Periodos Relacionados -->
                                
                                <ul class="p-2" style="list-style-type: none;">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <li><strong>ID</strong></li>
                                        <li><strong>Cuota</strong></li>
                                        <li><strong>Fecha Vencimiento</strong></li>
                                        <li><strong>Monto</strong></li>   
                                    </div>
                                    @foreach ($f->periodos as $periodo)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <li class="flex-fill text-center">{{ $periodo->periodo_id }}</li>
                                        <li class="flex-fill text-center">{{ $periodo->numero }}</li>
                                        <li class="flex-fill text-center">{{ $periodo->fecha_vencimiento }}</li>
                                        <li class="flex-fill text-center">{{ $periodo->monto }}</li>
                                    </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5"> 
                        
                        <h5 class="mb-4 text-center">Comentarios de la Factura</h5>
                        
                            @foreach ($f->comentariosFactura as $comentario)
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
                                        
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
