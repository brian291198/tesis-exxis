@extends('admin.plantilla')
@section('title','Importación')
 
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
<!-- resources/views/import/import.blade.php -->


    <div class="container">
        <h1>Importar y Previsualizar Excel</h1>
        <form action="{{ route('import.preview') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class=" ">
                <label for="excel_file">Subir Archivo Excel:</label>
                <input type="file" name="excel_file" id="excel_file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Previsualizar</button>
        </form>
    </div>


    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            iziToast.success({
                title: 'Éxito',
                message: "{{ session('success') }}",
                position: 'topCenter',
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
                    position: 'topCenter',
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



@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

@endsection

