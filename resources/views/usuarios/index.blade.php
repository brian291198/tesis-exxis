@extends('admin.plantilla')
@section('title','Usuarios')
@section('css')
   <!-- bootstrap -->
   {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}


<style>
  .pagination-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
  }
  .pagination {
      list-style-type: none;
      display: flex;
  }
  .pagination li {
      margin: 0 5px;
  }
  .pagination a {
      text-decoration: none;
      padding: 5px 10px;
      color: #007bff;
      border: 1px solid #dee2e6;
      border-radius: 3px;
  }
  .pagination a.active {
      background-color: #007bff;
      color: white;
  }
  .pagination a.disabled {
      color: #6c757d;
      cursor: not-allowed;
  }
</style>
@endsection

@section('content')

<div class="col-lg-3 col-md-6 col-sm-6 col-12">
  <div class="card card-statistic-1">
    <div class="card-icon bg-primary">
      <i class="far fa-user"></i>
    </div>
    <div class="card-wrap">
      <div class="card-header">
        <h4>Total Admin</h4>
      </div>
      <div class="card-body">
       {{$totalUsuarios}}
      </div>
    </div>
  </div>
</div>

<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Usuarios</h3>
  </div>
  <div class="section-body">
      <div class="row">
          <div class="col-lg-12">
              <div class="card table-responsive">
                  <div class="card-body">



<div class="card">
    <div class="card-header">
      <h4>Lista de Usuarios</h4>
    </div>
    <div class="card-header">
      @can('Crear usuarios')
          <h4>
            <a href="{{route('usuarios.create')}}" class="btn btn-primary"><i class="bi bi-plus-circle-fill mr-2"></i>Crear nuevo</a>
          </h4>
      @endcan

      <div class="card-header-form">
        <form method="get" action="{{route('usuarios.index')}}">
          <div class="input-group">
            <input type="text" class="form-control" name="buscarpor" placeholder="Buscar">
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover" >
        <thead>

            <th scope="col">N°</th>
            <th scope="col">Nombre</th>
            <th scope="col">E-mail</th>
            <th scope="col">Rol</th>
            @can('Editar usuarios')
            <th scope="col">Acciones</th>
            @endcan
          </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td>
                    @if(!empty($usuario->getRoleNames()))
                     
                        @foreach($usuario->getRoleNames() as $rolName)
                        <h5><span class="badge badge-dark">{{$rolName}}</span></h5>
                        @endforeach

                    @endif
                </td>
                @can('Editar usuarios')
                  <td>
                      <a href="{{route('usuarios.edit', $usuario->id)}}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
                      <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}" style="display:inline">
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

      <div class="pagination-container">
        {{ $usuarios->appends(['buscarpor' => request()->input('buscarpor')])->links() }}
    </div>
{{--       <div class="pagination justify-content-end">
        {{ $usuarios->links() }}
    </div> --}}

{{--     <div class="card-footer text-right">
      <nav class="d-inline-block">
          { !!$userpag->links() !!}
      </nav>
  </div> --}}
    </div>
    {{-- <div class="card-footer text-right">
      <nav class="d-inline-block">
        <ul class="pagination mb-0">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
          </li>
        </ul>
      </nav>
    </div> --}}

  </div>
</div>
                     
</div>
</div>
</div>
</div>

</section>

@endsection

@section('script')
 {{--  <!-- bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}


 
   {{--  <script>
   document.addEventListener('DOMContentLoaded', function() {
    // Función para manejar la paginación
    function handlePagination() {
        // Selecciona todos los elementos 'a' dentro de '.pagination'
        var paginationLinks = document.querySelectorAll('.pagination a');

        // Itera sobre cada enlace de paginación
        paginationLinks.forEach(function(link) {
            // Agrega un event listener para el evento 'click'
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Evita el comportamiento predeterminado del enlace

                var url = this.getAttribute('href'); // Obtiene la URL del atributo 'href' del enlace

                // Realiza una solicitud GET usando fetch
                fetch(url)
                    .then(function(response) {
                        return response.text(); // Convierte la respuesta a texto
                    })
                    .then(function(data) {
                        document.body.innerHTML = data; // Reemplaza el contenido del cuerpo con la respuesta recibida
                    })
                    .catch(function(error) {
                        console.error('Error fetching data:', error); // Maneja errores de la solicitud
                    });
            });
        });
    }

    handlePagination(); // Llama a la función para manejar la paginación al cargar el documento
});

    </script> --}}
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para manejar la paginación
    function handlePagination() {
        // Selecciona todos los elementos 'a' dentro de '.pagination'
        var paginationLinks = document.querySelectorAll('.pagination a');

        // Itera sobre cada enlace de paginación
        paginationLinks.forEach(function(link) {
            // Agrega un event listener para el evento 'click'
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Evita el comportamiento predeterminado del enlace

                var url = this.getAttribute('href'); // Obtiene la URL del atributo 'href' del enlace

                // Extrae el número de página actual de la URL actual
                var currentPageNumber = getCurrentPageNumber(url);

                // Realiza una solicitud GET usando fetch
                fetch(url)
                    .then(function(response) {
                        return response.text(); // Convierte la respuesta a texto
                    })
                    .then(function(data) {
                        // Reemplaza el contenido del cuerpo con la respuesta recibida
                        document.body.innerHTML = data;

                        // Actualiza la URL en la barra de direcciones para reflejar la página actual
                        history.pushState({}, '', updateQueryStringParameter(window.location.href, 'page', currentPageNumber));
                    })
                    .catch(function(error) {
                        console.error('Error fetching data:', error); // Maneja errores de la solicitud
                    });
            });
        });
    }

    // Función para obtener el número de página actual de la URL
    function getCurrentPageNumber(url) {
        var urlParams = new URLSearchParams(url.split('?')[1]);
        return urlParams.get('page') || 1; // Devuelve el número de página o 1 si no se especifica
    }

    // Función para actualizar el parámetro de consulta 'page' en la URL
    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }

    handlePagination(); // Llama a la función para manejar la paginación al cargar el documento
});


    </script>
@endsection



