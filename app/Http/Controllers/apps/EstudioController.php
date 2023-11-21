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
    $establecimiento = Establecimiento::find($idEst);

    if (!$establecimiento) {
        return response()->json(['error' => 'Establecimiento no encontrado'], 404);
    }

    $estudios = $establecimiento->estudios->map(function ($estudio) {
        return [
            'idEstudio' => $estudio->idEstudio,
            'NombreEstudio' => $estudio->NombreEstudio,
            'is_active' => $estudio->pivot->is_active
        ];
    });

    return response()->json($estudios);
}

public function addEstudioToEstablecimiento(Request $request, $idEst)
{
    $establecimiento = Establecimiento::find($idEst);
    if (!$establecimiento) {
        return response()->json(['error' => 'Establecimiento no encontrado'], 404);
    }

    $estudioId = $request->input('estudioID');
    $isActive = $request->input('is_active', true);
    $servId = $request->input('servID');
    $areaId = $request->input('areaID');

    $establecimiento->estudios()->attach($estudioId, [
        'is_active' => $isActive,
        'servID' => $servId,
        'areaID' => $areaId
    ]);

    return response()->json(['message' => 'Estudio añadido al establecimiento con éxito']);
}





}
