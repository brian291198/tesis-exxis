<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Cambio</title>
</head>
<body>

    <h1>Tipo de Cambio SUNAT</h1>

    <form method="POST" action="{{ route('tipocambio.scrape') }}">
        @csrf
        <button type="submit">Obtener Tipo de Cambio</button>
    </form>

    <div>
        <h2>Datos del Tipo de Cambio:</h2>
        <label for="date">Fecha:</label>
        <input type="text" id="date" value="{{ session('tipoCambio.date') ?? '' }}"><br>

        <label for="sell-rate">Valor de Venta:</label>
        <input type="text" id="sell-rate" value="{{ session('tipoCambio.sellRate') ?? '' }}">
    </div>
    <script>

        
        </script>
</body>
</html>


