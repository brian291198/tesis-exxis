@extends('admin.plantilla')
@section('title','Roles')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card table-responsive">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Lista de Roles</h4>
                                  </div>
                                  <div class="card-header">
                                @can('Crear roles')
                                    <h4>
                                        <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="bi bi-plus-circle-fill mr-2"></i>Crear nuevo</a>
                                    </h4>
                                @endcan
                          
                          
                          
                                <div class="card-header-form">
                                  <form method="get" action="{{route('roles.index')}}">
                                    <div class="input-group">
                                      <input type="text" class="form-control" name="buscarpor" placeholder="Buscar">
                                      <div class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                            </div>
{{-- Definimos las directivas de laravel permission --}}
                              
                               
                            <table class="table table-hover">


                                    <thead>
                                        <tr>
                                           <th scope="col">ID</th>
                                           <th scope="col">Rol</th>
                                           @can('Editar roles')
                                           <th scope="col">Acciones</th>
                                           @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                           <td>{{$role->name}}</td>
                                           @can('Editar roles')
                                           <td>
                                                <a class="btn btn-info" href="{{ route('roles.edit',$role->id)}}"><i class="bi bi-pencil-square"></i></a>
                                               <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                           </td>
                                           @endcan
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            <div class="pagination justify-content-end" style="margin: 20px 0;">
                                {!! $roles->links() !!}
                            </div>
                            
                        </div>
                    </div>
                     
                    </div>
                </div>
            </div>
       
        
    </section>
@endsection

