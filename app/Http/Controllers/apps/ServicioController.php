<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

//     public function getServicios($idEst = null)
// {
//     // Obtener todos los servicios
//     $allServicios = Servicio::all();

//     $estabServicios = [];

//     // Si $idEst está presente, obten los servicios específicos de ese establecimiento
//     if ($idEst) {
//         $estabAreaIDs = DB::table('establecimiento_area')
//                           ->where('estID', $idEst)
//                           ->pluck('idEst_Area');

//         $estabServicios = Servicio::join('establecimiento_area_servicio', 'servicios.idServ', '=', 'establecimiento_area_servicio.servID')
//                                   ->whereIn('establecimiento_area_servicio.est_AreaID', $estabAreaIDs)
//                                   ->select('servicios.*')
//                                   ->get();
//     }

//     return response()->json(['allServicios' => $allServicios, 'estabServicios' => $estabServicios]);
// }

public function getServicios()
  {
      // Obtener todas las áreas
      $allServicios = Servicio::all();

      return response()->json(['allServicios' => $allServicios]);
  }





}
