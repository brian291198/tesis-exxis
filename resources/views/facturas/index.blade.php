@extends('admin.plantilla')
@section('title','Facturas')
@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

<style>
    .btn-success {
        background-color: #36aa6a !important;
        color: white !important;
    }

    .btn-danger {
        background-color: #ff0000 !important;
        color: white !important;
    }

</style>

@endsection

@section('content')

@can('Crear facturas')
<div class="mb-3 mt-1">
    <button class="btn btn-primary" data-toggle="modal" data-target="#createFacturaModal">
        <i class="bi bi-plus-circle-fill mr-2"></i>Crear nueva factura
    </button>
</div>
@endcan

@include('facturas.modal.create')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header" style="display: flex; flex-direction: column;">
            <h2>Lista de Facturas</h2>
            <h5>Total: {{$totalFacturas}}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 d-flex align-items-center">
                    @include('facturas.modal.pag')
                </div>

                <div class="col-12 col-md-6 my-3">
                    <form method="get" action="{{route('facturas.index')}}">
                        <div class="input-group d-flex justify-content-center align-items-center">
                            <input type="text" class="form-control" name="buscarpor" placeholder="Buscar">
                            <div class="input-group-append">
                                <button class="ml-2 btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-1">
              <thead>                                 
                <tr>
                    <th class="text-center">N°</th>
                    <th>ID Factura</th>
                    <th>Cliente</th>
                    <th>Saldo Pendiente</th>
                    <th>Fecha de Emisión</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Acción</th>
                </tr>
              </thead>
              <tbody>                                 
                @if (count($facturas) <= 0)
                    <tr>
                        <td class="text-center" colspan="7">No hay registros...</td>
                    </tr>
                @else
                    @foreach ($facturas as $key => $f)
                        <tr class="text-center">
                            <td data-toggle="modal" data-target="#showFacturaModal{{$f->factura_id}}">{{($facturas->currentPage() - 1) * $facturas->perPage() + $loop->index + 1}}</td>
                            <td data-toggle="modal" data-target="#showFacturaModal{{$f->factura_id}}">{{$f->factura_id}}</td>
                            <td class="text-left" data-toggle="modal" data-target="#showFacturaModal{{$f->factura_id}}">{{$f->cliente->nombre}}</td>
                            <td data-toggle="modal" data-target="#showFacturaModal{{$f->factura_id}}">{{$f->saldo_pendiente}}</td>
                            <td data-toggle="modal" data-target="#showFacturaModal{{$f->factura_id}}">{{$f->fecha_factura}}</td>
                            <td data-toggle="modal" data-target="#showFacturaModal{{$f->factura_id}}">{{$f->fecha_vencimiento}}</td>
                      
                            <td class="text-center" style="display: flex; justify-content: center; align-items: center;">
                                <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#showFacturaModal{{$f->factura_id}}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm mx-2" type="button" data-toggle="modal" data-target="#editFacturaModal{{$f->factura_id}}">
                                    <i class="far fa-edit"></i>
                                </button>
                                <form action="{{route('facturas.destroy',$f->factura_id)}}" method="POST" class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>

                            @include('facturas.modal.show')
                            @include('facturas.modal.edit')

                       
                        </tr>
                    @endforeach
                @endif
              </tbody>
            </table>
{{-- INICIO DE PAGINACIÓN --}}
<div class="d-flex justify-content-center my-3">
    @if ($facturas->lastPage() > 1)
<div>
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">

            {{-- Botón "Anterior" --}}
            @if ($facturas->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $facturas->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($facturas->currentPage() - 1) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif

            {{-- Definir el rango de páginas a mostrar --}}
            @php
                $start = max(1, $facturas->currentPage() - 2);  // Página inicial
                $end = min($facturas->lastPage(), $facturas->currentPage() + 2); // Página final

                // Ajustar el rango para mostrar siempre 5 páginas si es posible
                if ($facturas->lastPage() > 5) {
                    if ($facturas->currentPage() <= 3) {
                        $end = 5; // Mostrar las primeras 5 páginas
                    } elseif ($facturas->currentPage() > $facturas->lastPage() - 3) {
                        $start = $facturas->lastPage() - 4; // Mostrar las últimas 5 páginas
                    }
                }
            @endphp

            {{-- Mostrar los enlaces de las páginas dentro del rango --}}
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $facturas->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $facturas->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Botón "Siguiente" --}}
            @if ($facturas->currentPage() < $facturas->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $facturas->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($facturas->currentPage() + 1) }}" aria-label="Next">
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
                    @include('facturas.modal.pag')
                </div>
            </div>
          </div>
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
 