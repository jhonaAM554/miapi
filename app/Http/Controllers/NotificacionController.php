<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        return Notificacion::where('user_id', $request->user()->id)
                ->with('reporte')
                ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'reporte_id' => 'required|exists:reportes,id'
        ]);

        return Notificacion::create([
            'mensaje' => $request->mensaje,
            'user_id' => $request->user_id,
            'reporte_id' => $request->reporte_id
        ]);
    }

    public function show(Notificacion $notificacion)
    {
        return $notificacion;
    }

    public function update(Request $request, Notificacion $notificacion)
    {
        $notificacion->update($request->all());

        return $notificacion;
    }

    public function destroy(Notificacion $notificacion)
    {
        $notificacion->delete();

        return response()->json(null, 204);
    }
}