{{-- <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data"> --}}
{{-- <form  method="post" enctype="multipart/form-data">
    {{ method_field('patch') }}
    {{ csrf_field() }} --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="showClienteModal{{$c->cliente_id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información de Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Código:</strong> {{ $c->cliente_id }}</p>
                    <p><strong>Nombre:</strong> {{ $c->nombre }}</p>
                    <p><strong>RUC:</strong> {{ $c->ruc }}</p>
                        <div class="modal-footer bg-whitesmoke br justify-content-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                        </div>
                </div>
            </div>
        </div>
    </div>




