<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comentario;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'latitud',
        'longitud',
        'estado',
        'user_id'
    ];

    protected $appends = ['imagen_url'];

   public function comentarios()
{
    return $this->hasMany(Comentario::class);
}

public function getImagenUrlAttribute()
{
    if (!$this->imagen) {
        return null;
    }

    return asset('storage/' . $this->imagen);
}
}