@extends('admin.plantilla')
@section('title','Usuarios')
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Editar Usuario</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


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

<form method="POST" action="{{ route('usuarios.update', $user->id) }}">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" >
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="confirm-password">Confirmar Password</label>
                <input type="password" name="confirm-password" class="form-control">
            </div>
        </div>

        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name="roles[]" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}


{{-- DESCOMENTARRRRRRRRRRRRRRRRRRRRRRRRR --}}


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="roles">Roles</label>
                <select id="role-select" class="form-control">
                    <option value="">Seleccione un rol</option>
                    @foreach($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="selected-roles">Roles Seleccionados</label>
                <ul id="selected-roles" class="list-group">
                    @foreach($userRoles as $roleId)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $roles[$roleId] }}
                            <input type="hidden" name="roles[]" value="{{ $roleId }}">
                            <button type="button" class="btn btn-danger btn-sm remove-role">Eliminar</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>



 

        
        <div class="col-xs-12 col-sm-12 col-md-12 d-flex justify-content-center w-100">
            <button type="submit" class="btn btn-primary mx-2">Guardar</button>
            <a class="btn btn-secondary mx-2" href="{{ route('usuarios.index') }}">Cancelar</a>
        </div>

    </div>
</form>
         
</div>
</div>
</div>
</div>
</div>
</section>


@section('script')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role-select');
        const selectedRoles = document.getElementById('selected-roles');

        roleSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const selectedText = this.options[this.selectedIndex].text;

            // Verificar si el rol seleccionado ya está en la lista
            const alreadySelected = Array.from(selectedRoles.querySelectorAll('input[type="hidden"]'))
                .map(input => input.value)
                .includes(selectedValue);

            if (selectedValue !== "" && !alreadySelected) {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.innerHTML = `
                    ${selectedText}
                    <input type="hidden" name="roles[]" value="${selectedValue}">
                    <button type="button" class="btn btn-danger btn-sm remove-role">Eliminar</button>
                `;

                selectedRoles.appendChild(listItem);

                // Resetear el select
                this.value = "";

                // Añadir event listener al botón de eliminar
                listItem.querySelector('.remove-role').addEventListener('click', function() {
                    listItem.remove();
                });
            }
        });

        // Añadir event listeners a los botones de eliminar inicialmente presentes
        document.querySelectorAll('.remove-role').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
    });
</script>

@endsection

@endsection