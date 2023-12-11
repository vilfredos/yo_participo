<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votante_por_mesa extends Model
{
    use HasFactory;
    protected $table = 'votantes_por_mesa'; // Nombre de tu tabla

    // Aquí puedes especificar las columnas de tu tabla
    protected $fillable = ['sis', 'name', 'facultad', 'carrera', 'ci', 'numeroMesa'];
}