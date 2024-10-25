@extends('admin.plantilla')
@section('title','Áreas')
@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

<!-- Estilos CSS para los botones -->
<style>
    .btn-success {
        background-color: #36aa6a !important; /* Fondo verde */
        color: white !important; /* Texto blanco */
    }

    .btn-danger {
        background-color: #ff0000 !important; /* Fondo rojo */
        color: white !important; /* Texto blanco */
    }

</style>

@endsection

@section('content')


<div class="mb-3 mt-1">
<button class="btn btn-primary" data-toggle="modal" data-target="#createAreaModal"><i class="bi bi-plus-circle-fill mr-2"></i>Crear nuevo</button>
</div>


@include('areas.modal.create')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header" style="display: flex; flex-direction: column;">
            <h2>Lista de Áreas</h2>
        <h5>Cantidad: {{$totalAreas}}</h5>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                <div class="col-12-sm col-6-md"></div>
                <div class="col-12-sm col-6-md"></div>
            </div>
            <div class="d-flex justify-content-start my-3">
                <div>
                    @include('areas.modal.pag')
                </div>
            </div> --}}

            <div class="row">
    
                    <div class="col-12 col-md-6 d-flex align-items-center">
                      
                        @include('areas.modal.pag')

                </div>
          
      
                    <div class="col-12 col-md-6 my-3">
                     
                            <form method="get" action="{{route('areas.index')}}">
                              <div class="input-group d-flex justify-content-center align-items-center">

                                
                                    <input type="text" class="form-control" name="buscarpor" placeholder="Buscar">
                                
                                <div class="input-group-append">
                                    <button class="ml-2 btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>

                              </div>
                            </form>


                           {{--  <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary" type="button">Button</button>
                                </div> 
                        
                            </div>--}}

                              
                    </div>
          
            </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-1">
              <thead>                                 
                <tr>
                    <th  class="text-center">N°</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                </tr>
              </thead>
              <tbody>                                 

                @if (count($areas) <= 0)
                <tr>
                    <td class="text-center" colspan="7">No hay Registros...</td>
                </tr>
            @else
                @foreach ($areas as $key => $a)
                    <tr class="text-center">
                        <td data-toggle="modal" data-target="#showAreaModal{{$a->area_id}}">{{($areas->currentPage() - 1) * $areas->perPage() + $loop->index + 1}}</td>
                        <td class="text-left" data-toggle="modal" data-target="#showAreaModal{{$a->area_id}}">{{$a->nombre}} </td>
   
                 
                        <td class="text-center" style="display: flex; justify-content: center; align-items: center;">
                        
                            <button class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#showAreaModal{{$a->area_id}}"><i class="fas fa-eye"></i></button>
                                             
                            <button class="btn btn-warning btn-sm mx-2" type="button"  data-toggle="modal" data-target="#editAreaModal{{$a->area_id}}" ><i class="far fa-user"></i></button>
                                              
                            <form action="{{route('areas.destroy',$a->area_id)}}" method="POST" class="formulario-eliminar">
                                @csrf
                                @method('delete')
 
                                      <button class="btn btn-danger btn-sm" type="submit" id="swal-6"><i class="fas fa-trash-alt"></i></button>

                                
                            </form>
                        </td>

                        
                        @include('areas.modal.show')
                        @include('areas.modal.edit')

                    
                        </tr>
                        
                    @endforeach
                @endif
              </tbody>
            </table>
{{-- FIN DE TABLA --}}

{{-- INICIO DE PAGINACIÓN --}}
            <div class="d-flex justify-content-center my-3">
                @if ($areas->lastPage() > 1)
            <div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
        
                        {{-- Botón "Anterior" --}}
                        @if ($areas->currentPage() > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $areas->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($areas->currentPage() - 1) }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        @endif
        
                        {{-- Definir el rango de páginas a mostrar --}}
                        @php
                            $start = max(1, $areas->currentPage() - 2);  // Página inicial
                            $end = min($areas->lastPage(), $areas->currentPage() + 2); // Página final
        
                            // Ajustar el rango para mostrar siempre 5 páginas si es posible
                            if ($areas->lastPage() > 5) {
                                if ($areas->currentPage() <= 3) {
                                    $end = 5; // Mostrar las primeras 5 páginas
                                } elseif ($areas->currentPage() > $areas->lastPage() - 3) {
                                    $start = $areas->lastPage() - 4; // Mostrar las últimas 5 páginas
                                }
                            }
                        @endphp
        
                        {{-- Mostrar los enlaces de las páginas dentro del rango --}}
                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ $areas->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $areas->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
        
                        {{-- Botón "Siguiente" --}}
                        @if ($areas->currentPage() < $areas->lastPage())
                            <li class="page-item">
                                <a class="page-link" href="{{ $areas->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($areas->currentPage() + 1) }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        @endif
        
                        </ul>
                    </nav>
                </div>
            @endif
    
    
            </div>
{{-- FIN DE PAGINACIÓN --}}

            @if(session('success'))
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        iziToast.success({
                            title: 'Éxito',
                            message: "{{ session('success') }}",
                            position: 'topRight',
                            icon: 'fa fa-check', // Icono opcional
                            iconColor: '#ffffff', // Color del ícono
                            transitionIn: 'bounceInDown', // Efecto de entrada opcional
                            timeout: 5000, // Tiempo antes de que se cierre
                            backgroundColor: '#63ED7A', // Color de fondo (verde para éxito)
                            messageColor: '#ffffff', // Color del texto del mensaje
                            titleColor: '#ffffff' // Color del texto del título
                        });
                    });
                </script>
            @elseif(session('error'))
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        iziToast.error({
                            title: 'Error',
                            message: "{{ session('error') }}",
                            position: 'topRight',
                            icon: 'fa fa-times', // Icono opcional
                            iconColor: '#ffffff', // Color del ícono
                            transitionIn: 'bounceInDown', // Efecto de entrada opcional
                            timeout: 5000, // Tiempo antes de que se cierre
                            backgroundColor: '#FC544B', // Color de fondo (rojo para error)
                            messageColor: '#ffffff', // Color del texto del mensaje
                            titleColor: '#ffffff' // Color del texto del título
                        });
                    });
                </script>
            @endif







            <div class="d-flex justify-content-center my-3">
                <div>
                    @include('areas.modal.pag')
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" tabindex="-1" role="dialog" id="columnModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Alerta!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Debe haber al menos una columna visible.</p>
          </div>

      </div>
    </div>
  </div>


@endsection



@section('js')



  
  <!-- JS Libraies -->
  <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('backend/assets/js/page/modules-sweetalert.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

{{-- MODAL PARA ELIMINACIÓN DE REGISTRO --}}

<script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        swal({
            title: "¿Estás seguro?",
            text: "Una vez eliminado, no podrás recuperar este registro!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    closeModal: true
                },
                confirm: {
                    text: "Eliminar",
                    value: true,
                    visible: true,
                    className: "btn-danger", // Clase para el botón Eliminar
                    closeModal: true
                }
            },
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Si se confirma, enviar el formulario
                this.submit();
            } else {
                // Mensaje de archivo salvado en color primary
                swal({
                    title: "¡Tu registro está a salvo!", // Modificar el texto aquí
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: "Ok",
                            value: true,
                            visible: true,
                            className: "btn btn-primary", // Clase para el botón Aceptar
                            closeModal: true
                        }
                    }
                });
            }
        });
    });
</script>


@endsection
 