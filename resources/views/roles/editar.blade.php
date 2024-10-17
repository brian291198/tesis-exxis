@extends('admin.plantilla')
@section('title','Roles')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
{{-- CONTENIDO --}}                          
                           {{-- cuadro que informe los errores de campos no llenados --}}
                            @if($errors->any())
                            <div class="alert alert-dark alert alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach($errors->all() as $error)
                                <br><i class="bi bi-exclamation-circle"></i><span {{-- class="badge badge-danger" --}}>{{$error}}</span>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                           {{-- formulario --}}
                           
                           <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre del Rol</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
                                    </div>
                                </div>
                        
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="permissions">Permisos para este Rol</label>
                                        <br>
                                        @foreach($permission as $value)
                                            <label>
                                                <input type="checkbox" name="permission[]" value="{{ $value->name }}" class="name" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                {{ $value->name }}
                                            </label>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-xs-12 col-sm-12 col-md-12 d-flex justify-content-center w-100">
                                <button type="submit" class="btn btn-primary mx-2">Guardar</button>
                                <a class="btn btn-secondary mx-2" href="{{ route('roles.index') }}">Cancelar</a>
                            </div>
                        </form>
                        







{{--   FIN DE CONTENIDO  --}}                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection