

    <div class="modal fade" tabindex="-1" role="dialog" id="editPeriodoModal{{$p->periodo_id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Período</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('periodos.update', $p->periodo_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('patch') }}
                    <div class="form-group" style="display: none;">
                        <label for="periodo_id">ID del Período</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="periodo_id" value="{{ old('periodo_id', $p->periodo_id) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="fecha_vencimiento" required value="{{ old('fecha_vencimiento', $p->fecha_vencimiento) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">Estado</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="status" value="{{ old('status', $p->status) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="area_id">ID del Área</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="area_id" required value="{{ old('area_id', $p->area_id) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="factura_id">ID de Factura</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="factura_id" required value="{{ old('factura_id', $p->factura_id) }}">
                        </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Período</button>
                </div>
            </div>
        </div>
    </div>

