<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    // Define aquí tus propiedades si quieres
    protected $fillable = ['nombre', 'descripcion', 'activo'];
}
