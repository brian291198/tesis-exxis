<form action="{{ route('areas.update', $a->area_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field('patch') }}

    <div class="modal fade" tabindex="-1" role="dialog" id="editAreaModal{{$a->area_id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Área</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="display: none;">
                        <label for="area_id">ID del Área</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="area_id" value="{{ old('area_id', $a->area_id) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre del Área</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nombre" required value="{{ old('nombre', $a->nombre) }}">
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Área</button>
                </div>
            </div>
        </div>
    </div>
</form>
