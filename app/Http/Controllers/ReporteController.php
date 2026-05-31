<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        return Reporte::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        return Reporte::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'estado' => $request->estado ?? 'Pendiente',
            'user_id' => $request->user()->id
        ]);
    }

    public function show(Reporte $reporte)
    {
        return $reporte;
    }

    public function update(Request $request, Reporte $reporte)
    {
        $reporte->update($request->all());

        return $reporte;
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return response()->json(null, 204);
    }
}