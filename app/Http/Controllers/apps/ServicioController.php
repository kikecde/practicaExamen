<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
    return response()->json($servicios);
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $servicio = Servicio::create($request->all());

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicios'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $servicio->update($request->all());

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }

    public function getServicios($idEst)
{
    $servicios = Servicio::join('establecimiento_servicio', 'servicios.idServ', '=', 'establecimiento_servicio.servicioID')
                         ->where('establecimiento_servicio.estID', $idEst)
                         ->select('servicios.*')
                         ->get();
    return response()->json($servicios);
}



}
