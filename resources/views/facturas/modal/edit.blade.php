<form action="{{ route('facturas.update', $f->factura_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field('patch') }}

    <div class="modal fade" tabindex="-1" role="dialog" id="editFacturaModal{{$f->factura_id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="display: none;">
                        <label for="factura_id">ID de Factura</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="factura_id" value="{{ old('factura_id', $f->factura_id) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_factura">Fecha de Factura</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" name="fecha_factura" required value="{{ old('fecha_factura', $f->fecha_factura) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="saldo_pendiente">Saldo Pendiente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                            <input type="number" step="0.01" class="form-control" name="saldo_pendiente" required value="{{ old('saldo_pendiente', $f->saldo_pendiente) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cliente_id">ID del Cliente</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cliente_id" value="{{ old('cliente_id', $f->cliente_id) }}" required>
                        </div>
                    </div>


                    {{-- <div class="mb-3 col-6">
                        <label for="institution_id" class="form-label">Institución:</label>
                        <select name="institution_id" id="institution_id" class="form-control @error('institution_id') is-invalid @enderror">
                            <option value="">Seleccionar</option>
                            @foreach ($institutions as $id => $nombre)
                                <option value="{{ $id }}" {{ old('institution_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                            @endforeach
                        </select>
                        @error('institution_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="form-group">
                        <label>Select2</label>
                        <select class="form-control select2">
                          <option>Option 1</option>
                          <option>Option 2</option>
                          <option>Option 3</option>
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="concepto">Concepto</label>
                        <div class="input-group">
                            <textarea class="form-control" name="concepto">{{ old('concepto', $f->concepto) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipo_id">Tipo de Cambio ID</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="tipo_id" value="{{ old('tipo_id', $f->tipo_id) }}">
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Factura</button>
                </div>
            </div>
        </div>
    </div>
</form>
