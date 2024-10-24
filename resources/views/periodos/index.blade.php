@extends('admin.plantilla')
@section('title','Periodos')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<style>
      .btn-success {
        background-color: #36aa6a !important; /* Fondo verde */
        color: white !important; /* Texto blanco */
    }

    .btn-danger {
        background-color: #ff0000 !important; /* Fondo rojo */
        color: white !important; /* Texto blanco */
    }

    .btn-default {
        background-color: #f8f9fa; /* Color por defecto */
        color: #343a40; /* Texto oscuro */
    }
    .celda-oculta {
    background-color: red !important; /* Aplica un fondo rojo */
}
</style>
@endsection

@section('content')



        <div class="card">
            <div class="card-header" style="display: flex; flex-direction: column;">
                <h2>Lista de Periodos</h2>
                <h5>Cantidad: {{$totalPeriodos}}</h5>
            </div>

            @include('periodos.modal.create')

            <div class="d-flex justify-content-center my-3">
                <div>
                    @include('periodos.modal.pag')
                </div>
            </div>

            <div class="container mt-2 mb-3">
                <div class="table-responsive">
                    <table id="periodosTable" class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>Factura</th>
                                <th>Cuota</th>
                                <th>Monto</th>
                                <th>Fecha de Vencimiento</th>
                                <th>Fecha de Pago</th>
                                <th>Area encargada</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($periodos) <= 0)
                            <tr>
                                <td class="text-center" colspan="7">No hay Registros...</td>
                            </tr>
                            @else
                            @foreach ($periodos as $key => $p)
                            <tr class="text-center">
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{($periodos->currentPage() - 1) * $periodos->perPage() + $loop->index + 1}}</td>
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{$p->factura_id}}</td>
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{$p->numero}}</td>
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{$p->monto}}</td>
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{$p->fecha_vencimiento}}</td>
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{$p->fecha_pagado}}</td>
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{$p->area_id}}</td>
                                <td data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}">{{$p->status}}</td>
                                <td>
                                    <div class="m-1" style="display: flex; justify-content: center; align-items: center;">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#showPeriodoModal{{$p->periodo_id}}"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#editPeriodoModal{{$p->periodo_id}}"><i class="far fa-edit"></i></button>
                                    <form action="{{route('periodos.destroy', $p->periodo_id)}}" method="POST" class="formulario-eliminar">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                                </td>
                                @include('periodos.modal.show')
                                @include('periodos.modal.edit')
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center my-3">
                        @if ($periodos->lastPage() > 1)
                <div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
            
                            {{-- Botón "Anterior" --}}
                            @if ($periodos->currentPage() > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $periodos->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($periodos->currentPage() - 1) }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif
            
                            {{-- Definir el rango de páginas a mostrar --}}
                            @php
                                $start = max(1, $periodos->currentPage() - 2);  // Página inicial
                                $end = min($periodos->lastPage(), $periodos->currentPage() + 2); // Página final
            
                                // Ajustar el rango para mostrar siempre 5 páginas si es posible
                                if ($periodos->lastPage() > 5) {
                                    if ($periodos->currentPage() <= 3) {
                                        $end = 5; // Mostrar las primeras 5 páginas
                                    } elseif ($periodos->currentPage() > $periodos->lastPage() - 3) {
                                        $start = $periodos->lastPage() - 4; // Mostrar las últimas 5 páginas
                                    }
                                }
                            @endphp
            
                            {{-- Mostrar los enlaces de las páginas dentro del rango --}}
                            @for ($i = $start; $i <= $end; $i++)
                                <li class="page-item {{ $periodos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $periodos->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
            
                            {{-- Botón "Siguiente" --}}
                            @if ($periodos->currentPage() < $periodos->lastPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $periodos->appends(['records' => $numRecords, 'buscarpor' => $buscarpor])->url($periodos->currentPage() + 1) }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
            
                        </ul>
                    </nav>
                </div>
            @endif
            
            
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center my-3">
                <div>
                    @include('periodos.modal.pag')
                </div>
            </div>

        </div>

@endsection

@section('js')
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
 {{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script> --}}

  <!-- DataTables Buttons JS (para exportación) -->
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
  <!-- DataTables ColVis JS (para control de columnas) -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<!-- Font Awesome para los íconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Script para inicializar DataTables y manejar el modal -->
<script>
    $(document).ready(function() {
        // Inicializa DataTable
        var table = $('#periodosTable').DataTable({
            dom: 'Bfrtip',
           
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copiar al portapapeles',
                    className: 'btn btn-default', // Clase para personalizar el botón
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exportar solo columnas visibles
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success', // Clase personalizada para el botón de Excel
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger', // Clase personalizada para el botón de PDF
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'colvis', // Botón para el control de columnas
                    text: '<i class="fas fa-columns"></i> Filtrar Columnas',
                    titleAttr: 'Mostrar/Ocultar Columnas',
                   collectionLayout: 'fixed two-column',
                   postfixButtons: [
                    {
                        extend: 'colvisRestore',
                        text: 'Restaurar Columnas'
                    }
                ],
                    className: 'btn btn-info',
                    columnText: function ( dt, idx, title ) {
                        return (idx + 1) + ': ' + title;
                    }
                }

                
            ],
            columnDefs: [
            { targets: [3], visible: true } // Cambia el índice 3 al índice de la columna que quieras controlar
        ],
            pageLength: 5, // Establece el número de registros por página
            lengthChange: false, // Oculta el selector de cantidad de registros
            paging: false, // Desactiva la paginación
            info: false, // Oculta la información de paginación
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No hay datos disponibles en la tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando de 0 a 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sSearch":         "Buscar:",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }

            
        });

        // Forzar al menos una columna visible
        /* table.on('column-visibility.dt', function (e, settings, column, state) {
            var visibleColumns = table.columns(':visible').count();
            if (visibleColumns === 0) {
                table.column(column).visible(true);
                alert('Debe haber al menos una columna visible.');
            }
        });
         */

        // Forzar al menos una columna visible
        table.on('column-visibility.dt', function (e, settings, column, state) {
            var visibleColumns = table.columns(':visible').count();
            if (visibleColumns === 0) {
                table.column(column).visible(true);  // Asegura que siempre haya al menos una columna visible
                // Muestra el modal en lugar del alert
                var myModal = new bootstrap.Modal(document.getElementById('columnModal'), {
                    keyboard: false
                });
                myModal.show();
            }
        });



         // Desactivar el modal de copia
        $.extend($.fn.dataTable.Buttons.defaults, {
            copyTitle: '',
            copySuccess: {
                _: '',
                1: ''
            }
        });

        // Manejo del modal de copia
        $(document).on('copy', function(e) {
            alert('Los datos han sido copiados al portapapeles.');
        });




        /* FINAL DE DATATABLE */
    });
</script>




@if (session('datos') == 'OK') 
    <script>
        Swal.fire({
            title: "¡Eliminado!",
            text: "El registro se ha eliminado exitosamente.",
            icon: "success",
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            confirmButtonColor: "#28a745", // Color verde de confirmación
            timer: 3000, // El mensaje se cierra automáticamente después de 3 segundos
            timerProgressBar: true, // Barra de progreso
            backdrop: `rgba(0, 0, 0, 0.2)` // Fondo oscuro suave
        });
    </script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Este registro se eliminará de forma permanente.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545", // Rojo para eliminar
            cancelButtonColor: "#6c757d", // Gris para cancelar
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            reverseButtons: true, // Invertir botones para mejor UX
            showClass: {
                popup: 'animate__animated animate__shakeY' // Animación de sacudida
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            backdrop: `rgba(0, 0, 0, 0.2)` // Fondo oscuro suave
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma, se elimina el registro
                Swal.fire({
                    title: "¡Eliminado!",
                    text: "El registro ha sido eliminado.",
                    icon: "success",
                    confirmButtonColor: "#dc3545", // Mantener el rojo para confirmar la eliminación
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                }).then(() => {
                    this.submit(); // Envía el formulario después de la confirmación
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Si se cancela, se muestra mensaje de cancelación
                Swal.fire({
                    title: "Cancelado",
                    text: "La acción ha sido cancelada.",
                    icon: "error",
                    confirmButtonColor: "#6c757d", // Gris para cancelar
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
        });
    });
</script>



@endsection
