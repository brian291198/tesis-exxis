<form action="{{ route('periodos.store') }}" method="POST">
    @csrf

    <div class="modal fade" tabindex="-1" role="dialog" id="createPeriodoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo Período</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" name="fecha_vencimiento" required>
                        </div>
                        @error('fecha_vencimiento')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="area_id">ID del Área</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-th"></i>
                                </div>
                            </div>
                            <input type="number" class="form-control" placeholder="ID del Área" name="area_id" required>
                        </div>
                        @error('area_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Estado" name="status">
                        </div>
                    </div>
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
                        <button type="submit" class="btn btn-primary">Crear Período</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
