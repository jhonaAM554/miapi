<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reporte;
use App\Models\User;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenido',
        'user_id',
        'reporte_id'
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}