<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\DepartamentoNoMed;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class DepartamentoNoMedController extends Controller
{
    public function index()
    {
        $departamentosNoMed = DepartamentoNoMed::all();
    return response()->json($departamentosNoMed);
    }

    public function create()
    {
        return view('departamentosNoMed.create');
    }

    public function store(Request $request)
    {
        $departamentosNoMed = DepartamentoNoMed::create($request->all());

        return redirect()->route('departamentosNoMed.index')
            ->with('success', 'Departamento creado correctamente.');
    }

    public function edit(DepartamentoNoMed $departamentosNoMed)
    {
        return view('departamentosNoMed.edit', compact('departamentosNoMed'));
    }

    public function update(Request $request, DepartamentoNoMed $departamentoNoMed)
    {
        $departamentoNoMed->update($request->all());

        return redirect()->route('departamentosNoMed.index')
            ->with('success', 'Departamento no medico actualizado correctamente.');
    }

    public function destroy(DepartamentoNoMed $departamentoNoMed)
    {
        $departamentoNoMed->delete();

        return redirect()->route('departamentosNoMed.index')
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

    public function getDepartamentosNoMed()
  {
      // Obtener todas las áreas
      $allDepartamentosNoMed = DepartamentoNoMed::all();

      return response()->json(['allDepartamentosNoMed' => $allDepartamentosNoMed]);
  }


    // public function getDepartamentosNoMedPorArea($idEst = null, $idArea = null)
    // {
    //     $allDepartamentosNoMed = DepartamentoNoMed::all();
    //     $selectedDepartamentosNoMed = [];

    //     if ($idEst && $idArea) {
    //         // Primero, obtener los est_AreaID asociados con el idEst
    //         $estabAreaIDs = DB::table('establecimiento_area')
    //                           ->where('estID', $idEst)
    //                           ->pluck('idEst_Area');

    //         // Ahora, obtiene los departamentos asociados a un servicio específico y establecimiento
    //         $selectedDepartamentosNoMed = DepartamentoNoMed::join('establecimiento_area_departamentoNoMed', 'DepartamentosNoMed.idDeptoNoMed', '=', 'establecimiento_area_departamentoNoMed.deptoNoMedID')
    //                                         ->join('establecimiento_area_servicio', 'establecimiento_area_servicio.idEst_Area_Serv', '=', 'establecimiento_area_servicio_departamento.est_Area_ServID')
    //                                         ->whereIn('establecimiento_area_departamentoNoMed.est_AreaID', $estabAreaIDs)
    //                                         ->where('establecimiento_area_departamentoNoMed.deptoNoMedID', $idDeptoNoMed)
    //                                         ->select('DepartamentosNoMed.*')
    //                                         ->get();
    //     }

    //     return response()->json(['allDepartamentos' => $allDepartamentos, 'selectedDepartamentos' => $selectedDepartamentos]);
    // }








}
