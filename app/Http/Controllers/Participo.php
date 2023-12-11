<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Votante;
use App\Models\Votante_por_mesa;
use Illuminate\Support\Facades\DB;

class Participo extends Controller
{
    public function buscar(Request $request)
    {
        $codigo = $request->query('codigo');

        // Buscar en la tabla eleccion_sis
        $elecciones_sis = DB::table('eleccion_sis')->where('sis', $codigo)->get();

        $datos = [];

        foreach ($elecciones_sis as $eleccion_sis) {
            // Para cada eleccion_sis, buscar en las otras tablas
            $eleccion_votante_mesa = DB::table('eleccion_votante_mesa')->where('sis', $codigo)->first();
            $eleccion_comite = DB::table('eleccion_comite')->where('sis', $codigo)->first();
            $eleccion = DB::table('eleccion')->where('id', $eleccion_sis->id_eleccion)->first();
            $eleccion_jurados = DB::table('eleccion_jurados')->where('sis', $codigo)->first();
            $mesas = DB::table('mesas')->where('numeroMesa', $eleccion_votante_mesa->id_mesa)->first();

            // Buscar en la tabla facultad_ubicacion
            $facultad_ubicacion = DB::table('facultad_ubicacion')->where('ubicacion', $mesas->recinto)->first();

            // Buscar el nombre del votante en las tablas docentes y estudiantes
            $docente = DB::table('docentes')->where('sis', $codigo)->first();
            $estudiante = DB::table('estudiantes')->where('sis', $codigo)->first();

            // Agregar los datos a la respuesta
            $datos[] = [
                'eleccion_sis' => $eleccion_sis,
                'eleccion_votante_mesa' => $eleccion_votante_mesa,
                'eleccion_comite' => $eleccion_comite,
                'eleccion' => $eleccion,
                'eleccion_jurados' => $eleccion_jurados,
                'mesas' => $mesas,
                'facultad_ubicacion' => $facultad_ubicacion,
                'docente' => $docente,
                'estudiante' => $estudiante,
            ];
        }

        if (!empty($datos)) {
            // Redirige a la nueva pestaña con los datos del votante
            return view('votante', ['datos' => $datos]);
        } else {
            // Almacena el mensaje de error en la sesión
            session()->flash('error', 'El SIS introducido no es correcto');

            // Redirige a la misma página
            return back();
        }
    }
    public function index()
    {
        $elecciones = DB::table('eleccion')->get(); // Recupera todas las elecciones

        return view('welcome', compact('elecciones')); // Pasa las elecciones a la vista
    }
    public function Convocatoria($id)
    {
        $convocatoria = DB::table('eleccion')->where('id', $id)->first()->convocatoria;

        return response($convocatoria)
            ->header('Content-Type', 'application/pdf') // Asegúrate de que este es el tipo de contenido correcto para tu archivo
            ->header('Content-Disposition', 'inline; filename="convocatoria.pdf"');
    }
}
