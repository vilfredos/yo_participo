<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMSS</title>
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="UNSS Logo">
        </div>
        <h1>INGRESO SU CODIGO SIS</h1>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form action="{{ route('votante') }}" >
            <div class="search-bar">
                <label for="codigo" class="visually-hidden">Ingrese su codigo Sis</label>
                <input type="number" id="codigo" name="codigo" placeholder="sis" required>
                <button type="submit">Buscar</button>
            </div>
        </form>
        <h10>LISTA DE ELECCIONES</h10>     
        @foreach ($elecciones as $eleccion)
        <div class="eleccion">
            <h2>{{ $eleccion->titulo }}</h2>
            <p>{{ $eleccion->descripcion }}</p>
            <p>Fecha de inicio: {{ $eleccion->fecha_ini }}</p>
            <p>Fecha de fin: {{ $eleccion->ficha_fin }}</p>
            <a href="{{ route('convocatoria', ['id' => $eleccion->id]) }}" target="_blank">Ver convocatoria</a>        </div>
        @endforeach
    </div>
</body>

</html>