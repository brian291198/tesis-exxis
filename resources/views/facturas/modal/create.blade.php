<form action="{{ route('facturas.store') }}" method="POST">
    @csrf

    <div class="modal fade" tabindex="-1" role="dialog" id="createFacturaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nueva Factura</h5>
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
                    <div class="form-group">
                        <label for="fecha_factura">Fecha de Factura</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" name="fecha_factura" required>
                        </div>
                        @error('fecha_factura')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="saldo_pendiente">Saldo Pendiente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                            <input type="number" step="0.01" class="form-control" placeholder="Saldo Pendiente" name="saldo_pendiente" required>
                        </div>
                        @error('saldo_pendiente')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cliente_id">ID del Cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="ID del Cliente" name="cliente_id" required>
                        </div>
                        @error('cliente_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="concepto">Concepto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-comment-dots"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Concepto" name="concepto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo_id">Tipo de Cambio ID</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <input type="number" class="form-control" placeholder="ID de Tipo" name="tipo_id">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Factura</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
