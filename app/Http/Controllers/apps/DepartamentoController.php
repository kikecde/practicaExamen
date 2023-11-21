<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\Departamento;
use App\Models\Sector;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
    return response()->json($departamentos);
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        $departamento = Departamento::create($request->all());

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento creado correctamente.');
    }

    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit', compact('departamentos'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        $departamento->update($request->all());

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento actualizado correctamente.');
    }

    public function destroy(Departamento $departamento)
    {
        $departamento->delete();

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento eliminado correctamente.');
    }

    //     public function getDepartamentos($idEst = null)
    // {
    //     // Obtener todos los departamentos
    //     $allDepartamentos = Departamento::all();

    //     $estabDepartamentos = [];

    //     if ($idEst) {
    //         // Obtiene los IDs de los departamentos asociados al establecimiento a través de la relación
    //         $estabDeptoIDs = DB::table('establecimiento_area_servicio_departamento')
    //                           ->join('establecimiento_area_servicio', 'establecimiento_area_servicio.idEst_Area_Serv', '=', 'establecimiento_area_servicio_departamento.est_Area_ServID')
    //                           ->where('establecimiento_area_servicio.estID', $idEst)
    //                           ->pluck('deptoID');

    //         $estabDepartamentos = Departamento::whereIn('idDepto', $estabDeptoIDs)->get();
    //     }

    //     return response()->json(['allDepartamentos' => $allDepartamentos, 'estabDepartamentos' => $estabDepartamentos]);
    // }

    public function getDepartamentos()
  {
      // Obtener todas las áreas
      $allDepartamentos = Departamento::all();

      return response()->json(['allDepartamentos' => $allDepartamentos]);
  }


    public function getDepartamentosPorServicio($idEst = null, $idServ = null)
    {
        $allDepartamentos = Departamento::all();
        $selectedDepartamentos = [];

        if ($idEst && $idServ) {
            // Primero, obtener los est_AreaID asociados con el idEst
            $estabAreaIDs = DB::table('establecimiento_area')
                              ->where('estID', $idEst)
                              ->pluck('idEst_Area');

            // Ahora, obtiene los departamentos asociados a un servicio específico y establecimiento
            $selectedDepartamentos = Departamento::join('establecimiento_area_servicio_departamento', 'Departamentos.idDepto', '=', 'establecimiento_area_servicio_departamento.deptoID')
                                            ->join('establecimiento_area_servicio', 'establecimiento_area_servicio.idEst_Area_Serv', '=', 'establecimiento_area_servicio_departamento.est_Area_ServID')
                                            ->whereIn('establecimiento_area_servicio.est_AreaID', $estabAreaIDs)
                                            ->where('establecimiento_area_servicio.servID', $idServ)
                                            ->select('Departamentos.*')
                                            ->get();
        }

        return response()->json(['allDepartamentos' => $allDepartamentos, 'selectedDepartamentos' => $selectedDepartamentos]);
    }








}
