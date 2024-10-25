@extends('admin.plantilla')
@section('title','Importación')
 
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')


<!-- resources/views/import/preview.blade.php -->
<form action="{{ route('importExcel.save') }}" method="POST">
    @csrf
    @foreach ($clientes as $cliente)
        <input type="hidden" name="clientes[]" value="{{ json_encode($cliente) }}">
    @endforeach

    @foreach ($facturas as $factura)
        <input type="hidden" name="facturas[]" value="{{ json_encode($factura) }}">
    @endforeach

    @foreach ($periodos as $periodo)
        <input type="hidden" name="periodos[]" value="{{ json_encode($periodo) }}">
    @endforeach
    <div class="mb-3 mt-1">
        <button type="submit" class="btn btn-primary">Guardar Datos</button>
    </div>
</form>

{{-- @if (!empty($errors))
    <h1>Errores encontrados:</h1>
    <ul>
        @foreach ($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@else 
    <h1>{{ $message }}</h1> --}}
    <!-- Aquí puedes agregar la tabla para mostrar los datos importados (clientes, facturas, periodos) -->
    <div class="card pt-5">
<div class="card-header text-center">
        <h2>Previsualización de los Datos del Excel</h2>
    </div>
    <div class="card body mt-5">
    <div class="container">
        

       {{--      <input type="hidden" name="clientes" value="{{ json_encode($clientes) }}">
            <input type="hidden" name="facturas" value="{{ json_encode($facturas) }}">
            <input type="hidden" name="periodos" value="{{ json_encode($periodos) }}"> --}}

            <h3>Clientes</h3>
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código de Cliente</th>
                        <th>Nombre</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente['cliente_id'] }}</td>
                            <td>{{ $cliente['nombre'] }}</td>
                         
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <h3>Facturas</h3>
            <div class="table-responsive my-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Factura</th>
                        <th>Número de Cuotas</th>
                        <th>Saldo Pendiente</th>
                        <th>Fecha de Factura</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Código de Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                        <tr>
                            <td>{{ $factura['factura_id'] }}</td>
                            <td>{{ $factura['num_cuotas'] }}</td>
                            <td>{{ $factura['saldo_pendiente'] }}</td>
                            <td>{{ $factura['fecha_factura'] }}</td>
                            <td>{{ $factura['fecha_vencimiento'] }}</td>
                            <td>{{ $factura['cliente_id'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <h3>Periodos</h3>
            <div class="table-responsive my-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Factura</th>
                        <th>Cuota</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periodos as $periodo)
                        <tr>
                            <td>{{ $periodo['factura_id'] }}</td>
                            <td>{{ $periodo['numero'] }}</td>
                            <td>{{ $periodo['fecha_vencimiento'] }}</td>
                            <td>{{ $periodo['monto'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
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


     
    </div>
</div>
</div>





{{-- @endif
 --}}
   

    @endsection


    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    
    @endsection