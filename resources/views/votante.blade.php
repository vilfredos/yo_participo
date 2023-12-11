<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
<div class="container">
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    @foreach ($datos as $dato)
    <h2>Información para la elección: {{ $dato['eleccion']->titulo }}</h2>

    @if ($dato['docente'])
    <h3>Información del docente</h3>
    <p>Bienvenido al sistema Yo Participo {{ $dato['docente']->name }}</p>
    <!-- Muestra más información del docente si lo deseas -->
    @endif

    @if ($dato['estudiante'])
    <h3>Información del estudiante</h3>
    <p>Bienvenido al sistema Yo Participo {{ $dato['estudiante']->name }}</p>
    <!-- Muestra más información del estudiante si lo deseas -->
    @endif

    @if ($dato['eleccion_comite'])
    <h3>Información del jurado</h3>
    <p>Usted es parte del comit con el Cargo de : {{ $dato['eleccion_comite']->cargo }}</p>
    <p>en la {{ $dato['eleccion_comite']->facultad }}</p>
@else
    <h3>Información del comite</h3>
    <p>Usted no es parte del comite</p>
@endif
    

    @if ($dato['eleccion_jurados'])
    <h3>Información del jurado</h3>
    <p>Usted es parte del jurado con el Cargo de : {{ $dato['eleccion_jurados']->cargo }}</p>
    <p>en la Mesa numero: {{ $dato['eleccion_jurados']->id_mesa }}</p>
    @else
    <h3>Información del jurado</h3>
    <p> Usted no es parte del jurado</p>
    @endif

    <h3>Información de la mesa de sufragio</h3>
    <p>Debe emitir su voto en la mesa numero: {{ $dato['mesas']->numeroMesa }}</p>
    <p>Facultad: {{ $dato['mesas']->facultad }}</p>
    <p>Carrera: {{ $dato['mesas']->carrera }}</p>
    <p>Ubicado en:</p>
    <a href="{{ $dato['mesas']->recinto }}" target="_blank" style="color: #1CB5E0; font-weight: bold;">Ver ubicación en Google Maps</a>    <p>mas detalles en</p>
    @if (isset($dato['facultad_ubicacion']))
    <iframe src="{{ $dato['facultad_ubicacion']->script }}" 
width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@endif    
@endforeach
</div>
</body>
</html>