<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        return Comentario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string',
            'reporte_id' => 'required|exists:reportes,id'
        ]);

        return Comentario::create([
            'contenido' => $request->contenido,
            'user_id' => $request->user()->id,
            'reporte_id' => $request->reporte_id
        ]);
    }

    public function show(Comentario $comentario)
    {
        return $comentario;
    }

    public function update(Request $request, Comentario $comentario)
    {
        $comentario->update($request->all());

        return $comentario;
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();

        return response()->json(null, 204);
    }
}