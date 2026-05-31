<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
{
    return Reporte::with('comentarios.user')->get();
}

   public function store(Request $request)
{
    dd([
        'all' => $request->all(),
        'hasFile' => $request->hasFile('imagen'),
        'files' => $request->allFiles(),
    ]);
}
    public function show(Reporte $reporte)
    {
        return $reporte;
    }

   public function update(Request $request, Reporte $reporte)
{
    $estadoAnterior = $reporte->estado;

    $reporte->update($request->all());

    if (
        $request->has('estado') &&
        $estadoAnterior != $request->estado
    ) {

        Notificacion::create([
            'mensaje' => 'El estado de tu reporte cambió a: ' . $request->estado,
            'user_id' => $reporte->user_id,
            'reporte_id' => $reporte->id
        ]);
    }

    return $reporte;
}

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return response()->json(null, 204);
    }
}