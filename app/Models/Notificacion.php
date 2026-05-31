<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reporte;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';
    
    protected $fillable = [
        'mensaje',
        'leida',
        'user_id',
        'reporte_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reporte()
    {
        return $this->belongsTo(Reporte::class);
    }
}