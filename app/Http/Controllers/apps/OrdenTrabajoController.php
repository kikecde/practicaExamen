<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\OrdenTrabajo;
use App\Models\PSX;
use App\Models\Movil;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class OrdenTrabajoController extends Controller
{

  public function otManagement()
  {
    $ordenTrabajos = OrdenTrabajo::with('idMoviles')->get();
    $otCount = $ordenTrabajos->count();
    $otEnviado = OrdenTrabajo::whereNotNull('fechaEnviado')->get()->count();
    $otNoEnviado = OrdenTrabajo::whereNull('fechaEnviado')->get()->count();
    $otImpreso = OrdenTrabajo::whereNotNull('fechaImpreso')->get()->count();
    $otNoImpreso = OrdenTrabajo::whereNull('fechaImpreso')->get()->count();
    $otFinalizado = OrdenTrabajo::whereNotNull('fechaFinalizado')->get()->count();
    $otNoFinalizado = OrdenTrabajo::whereNull('fechaFinalizado')->get()->count();

    // Calcular porcentajes con solo 2 decimales
    $porcentajeEnviado = ($otCount > 0) ? number_format(($otEnviado / $otCount) * 100, 2) : 0;
    $porcentajeNoEnviado = ($otCount > 0) ? number_format(($otNoEnviado / $otCount) * 100, 2) : 0;
    $porcentajeImpreso = ($otCount > 0) ? number_format(($otImpreso / $otCount) * 100, 2) : 0;
    $porcentajeNoImpreso = ($otCount > 0) ? number_format(($otNoImpreso / $otCount) * 100, 2) : 0;
    $porcentajeFinalizado = ($otCount > 0) ? number_format(($otFinalizado / $otCount) * 100, 2) : 0;
    $porcentajeNoFinalizado = ($otCount > 0) ? number_format(($otNoFinalizado / $otCount) * 100, 2) : 0;

    return view('content.apps.app-ot-management', [
      'totalOT' => $otCount,
      'otEnviado' => $otEnviado,
      'otNoEnviado' => $otNoEnviado,
      'otImpreso' => $otImpreso,
      'otNoImpreso' => $otNoImpreso,
      'porcentajeEnviado' => $porcentajeEnviado,
      'porcentajeNoEnviado' => $porcentajeNoEnviado,
      'porcentajeImpreso' => $porcentajeImpreso,
      'porcentajeNoImpreso' => $porcentajeNoImpreso,
      'otFinalizado' => $otFinalizado,
      'otNoFinalizado' => $otNoFinalizado,
      'porcentajeFinalizado' => $porcentajeFinalizado,
      'porcentajeNoFinalizado' => $porcentajeNoFinalizado
    ]);

  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
      public function index(Request $request)
      {
        $columns = [
          1 => 'idOT',
          2 => 'movilID',
          3 => 'fechaOT',
          4 => 'condOT'
        ];

        $search = [];

        $totalData = OrdenTrabajo::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $column = $request->input('column', 0);
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (empty($request->input('search.value'))) {
          $ordenTrabajos = OrdenTrabajo::offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
          $search = $request->input('search.value');

          $ordenTrabajos = OrdenTrabajo::with('idMoviles')
            ->where('idOT', 'LIKE', "%{$search}%")
            ->orWhere('condOT', 'LIKE', "%{$search}%")
            ->orWhere('identidadMovil', 'LIKE', "%{$search}%")
            ->orWhere('fechaOT', 'LIKE', "%{$search}%")
            // ->orWhere('fechaEnviado', 'LIKE', "%{$search}%")
            // ->orWhere('fechaImpreso', 'LIKE', "%{$search}%")
            // ->orWhere('fechaFinalizado', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

          $totalFiltered = OrdenTrabajo::where('idOT', 'LIKE', "%{$search}%")
            ->orWhere('condOT', 'LIKE', "%{$search}%")
            //->orWhere('movilID', 'LIKE', "%{$search}%")
            ->orWhere('identidadMovil', 'LIKE', "%{$search}%")
            ->orWhere('fechaOT', 'LIKE', "%{$search}%")
            // ->orWhere('fechaImpreso', 'LIKE', "%{$search}%")
            // ->orWhere('fechaFinalizado', 'LIKE', "%{$search}%")
            ->count();
        }

        $data = [];

        if (!empty($ordenTrabajos)) {
          // providing a dummy id instead of database ids
          $ids = $start;

          foreach ($ordenTrabajos as $ordenTrabajo) {
            $nestedData['idOT'] = $ordenTrabajo->idOT;
            $nestedData['fake_id'] = ++$ids;
            $nestedData['identidadMovil'] = $ordenTrabajo->idMoviles->identidadMovil ?? null;

            $conductorIDs = explode(',', $ordenTrabajo->condOT);
            $conductoresNombres = PSX::whereIn('idPSX', $conductorIDs)->pluck('nYaPSX')->implode(', ');

            $nestedData['condOT'] = $conductoresNombres;
            $nestedData['fechaOT'] = $ordenTrabajo->fechaOT;
            $nestedData['fechaEnviado'] = $ordenTrabajo->fechaEnviado;
            $nestedData['fechaImpreso'] = $ordenTrabajo->fechaImpreso;
            $nestedData['fechaFinalizado'] = $ordenTrabajo->fechaFinalizado;
            $data[] = $nestedData;
          }
        }

        if ($data) {
          return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'code' => 200,
            'data' => $data,
          ]);
        } else {
          return response()->json([
            'message' => 'Internal Server Error',
            'code' => 500,
            'data' => [],
          ]);
        }
      }

    public function create()
    {
        return view('ordenTrabajos.create');
    }


    public function showOT($idOT)
    {
        // Recupera la orden de trabajo por su ID
        $ordenTrabajo = OrdenTrabajo::findOrFail($idOT);

        // Puedes pasar la orden de trabajo a una vista para mostrarla
        return view('app-ot-previsualizar', compact('ordenTrabajo'));
    }



    public function store(Request $request)
    {
        $ordenTrabajo = OrdenTrabajo::create($request->all());

        return redirect()->route('ordenTrabajos.index')
            ->with('success', 'Orden de Trabajo generada correctamente.');
    }


    public function edit($id)
  {
    $where = ['idOT' => $id];

    $ordenTrabajos = OrdenTrabajo::where($where)->first();

    return response()->json($ordenTrabajos);
  }

    public function update(Request $request, OrdenTrabajo $ordenTrabajo)
    {
        $ordenTrabajo->update($request->all());

        return redirect()->route('ordenTrabajos.index')
            ->with('success', 'Orden de Trabajo actualizada correctamente.');
    }



    public function destroy($id)
  {
    $ordenTrabajos = OrdenTrabajo::where('idOT', $id)->delete();
  }

  public function getOrdenesTrabajo($idOT)
  {
      try {
          $ordenTrabajo = OrdenTrabajo::findOrFail($idOT);

          // Puedes cargar relaciones si es necesario
          // $ordenTrabajo->load('otrelacionada');

          // Devuelve la Orden de Trabajo en formato JSON
          return response()->json([
              'message' => 'Orden de Trabajo recuperada exitosamente',
              'data' => $ordenTrabajo,
          ], 200);
      } catch (\Exception $e) {
          return response()->json([
              'message' => 'Error al recuperar la Orden de Trabajo',
              'error' => $e->getMessage(),
          ], 500);
      }
  }




}

