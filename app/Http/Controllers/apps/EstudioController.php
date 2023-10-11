<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Servicio;
use App\Models\Estudio;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class EstudioController extends Controller
{
    public function index()
    {
        $estudios = Estudio::all();
    return response()->json($estudios);
    }

    public function create()
    {
        return view('estudios.create');
    }

    public function store(Request $request)
    {
        $estudio = Estudio::create($request->all());

        return redirect()->route('estudios.index')
            ->with('success', 'Estudio creado correctamente.');
    }

    public function edit(Estudio $estudio)
    {
        return view('estudios.edit', compact('estudios'));
    }

    public function update(Request $request, Estudio $estudio)
    {
        $estudio->update($request->all());

        return redirect()->route('estudios.index')
            ->with('success', 'Estudio actualizado correctamente.');
    }

    public function destroy(Estudio $estudio)
    {
        $estudio->delete();

        return redirect()->route('estudios.index')
            ->with('success', 'Estudio eliminado correctamente.');
    }

    public function getEstudios($idEst)
{
    $estudios = Estudio::join('establecimiento_estudio', 'estudios.idEstudio', '=', 'establecimiento_estudio.estudioID')
                         ->where('establecimiento_estudio.estID', $idEst)
                         ->select('estudios.*')
                         ->get();
    return response()->json($estudios);
}



}
