<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Servicio;
use App\Models\CapacidadCama;
use App\Models\MovimientoCama;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class MovimientoCamaController extends Controller
{

  public function camasManagementRegion()
{
    $regionID = 10; // Reemplaza 10 por el ID de la región de interés.

    $movimientoCount = MovimientoCama::where('fechaRegistro', '>=', now()->subDay())->count();

    $camasOperativas = CapacidadCama::whereHas('establecimiento.region', function ($query) use ($regionID) {
        $query->where('idRegion', $regionID);
    })->sum('capacidadUnidades');

    $camasOcupadas = MovimientoCama::whereHas('establecimientoServicio.establecimiento.region', function ($query) use ($regionID) {
        $query->where('idRegion', $regionID);
    })->latest('fechaRegistro')->sum('camasOcupadas');

    $altasUltimas24Horas = MovimientoCama::whereHas('establecimientoServicio.establecimiento.region', function ($query) use ($regionID) {
        $query->where('idRegion', $regionID);
    })->where('tipoReporte', 1)->where('fechaRegistro', '>=', now()->subDay())->sum('altasUltimas24Horas');

    $serviciosSinCambios = CapacidadCama::whereHas('establecimiento.region', function ($query) use ($regionID) {
        $query->where('idRegion', $regionID);
    })->whereDoesntHave('movimientos', function ($query) {
        $query->where('fechaRegistro', '>=', now()->subDay());
    })->count();

    $disponibles = CapacidadCama::whereHas('establecimiento.region', function ($query) use ($regionID) {
      $query->where('idRegion', $regionID);
    })->with(['movimientos' => function ($query) {
        $query->latest('fechaRegistro')->take(1);
    }])->get();


    $porcentajeReportado = ($movimientoCount > 0) ? number_format(($serviciosSinCambios / $movimientoCount) * 100, 2) : 0;
    $porcentajeCamasOcupadas = ($camasOperativas > 0) ? number_format(($camasOcupadas / $camasOperativas) * 100, 2) : 0;
    $camasDisponibles = $camasOperativas - $camasOcupadas;
    $porcentajeCamasDisponibles = ($camasOperativas > 0) ? number_format(($camasDisponibles / $camasOperativas) * 100, 2) : 0;

    return view('content.apps.app-camas-region-management', [
        'movimientoCount' => $movimientoCount,
        'camasOperativas' => $camasOperativas,
        'camasOcupadas' => $camasOcupadas,
        'altasUltimas24Horas' => $altasUltimas24Horas,
        'serviciosSinCambios' => $serviciosSinCambios,
        'disponibles' => $disponibles,
        'porcentajeReportado' => $porcentajeReportado,
        'porcentajeCamasOcupadas' => $porcentajeCamasOcupadas,
        'porcentajeCamasDisponibles' => $porcentajeCamasDisponibles
    ]);
}

public function camasManagementEstablecimiento($establecimientoID)
{
    // Obtener todos los movimientos de camas del establecimiento
    $movimientoCamas = MovimientoCama::whereHas('establecimientoServicio', function ($query) use ($establecimientoID) {
        $query->where('capacidadIdEst', $establecimientoID);
    })->with('establecimientoServicio')->get();

    $movimientoCount = MovimientoCama::where('fechaRegistro', '>=', now()->subDay())->count();

    $camasOperativas = CapacidadCama::where('capacidadIdEst', $establecimientoID)->sum('capacidadUnidades');

    $camasOcupadas = MovimientoCama::whereHas('establecimientoServicio', function ($query) use ($establecimientoID) {
        $query->where('capacidadIdEst', $establecimientoID);
    })->latest('fechaRegistro')->sum('camasOcupadas');

    $altasUltimas24Horas = MovimientoCama::whereHas('establecimientoServicio', function ($query) use ($establecimientoID) {
        $query->where('capacidadIdEst', $establecimientoID);
    })->where('tipoReporte', 1)->where('fechaRegistro', '>=', now()->subDay())->sum('altasUltimas24Horas');

    $serviciosSinCambios = CapacidadCama::where('estID', $establecimientoID)
        ->whereDoesntHave('movimientos', function ($query) {
            $query->where('fechaRegistro', '>=', now()->subDay());
        })
        ->count();

    $disponibles = CapacidadCama::where('capacidadIdEst', $establecimientoID)
        ->with(['movimientos' => function ($query) {
            $query->latest('fechaRegistro')->take(1);
        }])
        ->get();

    // Calcular porcentajes con solo 2 decimales
    $porcentajeReportado = ($movimientoCount > 0) ? number_format(($serviciosSinCambios / $movimientoCount) * 100, 2) : 0;
    $porcentajeCamasOcupadas = ($camasOperativas > 0) ? number_format(($camasOcupadas / $camasOperativas) * 100, 2) : 0;
    $camasDisponibles = $camasOperativas - $camasOcupadas;
    $porcentajeCamasDisponibles = ($camasOperativas > 0) ? number_format(($camasDisponibles / $camasOperativas) * 100, 2) : 0;

    return view('content.apps.app-camas-establecimiento-management', [
        'movimientoCount' => $movimientoCount,
        'camasOperativas' => $camasOperativas,
        'camasOcupadas' => $camasOcupadas,
        'altasUltimas24Horas' => $altasUltimas24Horas,
        'serviciosSinCambios' => $serviciosSinCambios,
        'disponibles' => $disponibles,
        'porcentajeReportado' => $porcentajeReportado,
        'porcentajeCamasOcupadas' => $porcentajeCamasOcupadas,
        'porcentajeCamasDisponibles' => $porcentajeCamasDisponibles,
    ]);
}

    public function camasManagementServicios()
    {
        // Resto del código para obtener datos generales de servicios en toda la región.
        $regionID = 10; // Reemplaza 10 por el ID de la región de interés.

        $movimientoCount = MovimientoCama::where('fechaRegistro', '>=', now()->subDay())->count();

        $camasOperativas = CapacidadCama::whereHas('establecimiento.region', function ($query) use ($regionID) {
            $query->where('idRegion', $regionID);
        })->sum('capacidadUnidades');

        $camasOcupadas = MovimientoCama::whereHas('establecimientoServicio.establecimiento.region', function ($query) use ($regionID) {
            $query->where('idRegion', $regionID);
        })->latest('fechaRegistro')->sum('camasOcupadas');

        $altasUltimas24Horas = MovimientoCama::whereHas('establecimientoServicio.establecimiento.region', function ($query) use ($regionID) {
            $query->where('idRegion', $regionID);
        })->where('tipoReporte', 1)->where('fechaRegistro', '>=', now()->subDay())->sum('altasUltimas24Horas');

        $serviciosSinCambios = CapacidadCama::whereHas('establecimiento.region', function ($query) use ($regionID) {
            $query->where('idRegion', $regionID);
        })->whereDoesntHave('movimientos', function ($query) {
            $query->where('fechaRegistro', '>=', now()->subDay());
        })->count();

        $disponibles = CapacidadCama::whereHas('establecimiento.region', function ($query) use ($regionID) {
            $query->where('idRegion', $regionID);
        })->with(['movimientos' => function ($query) {
            $query->latest('fechaRegistro')->take(1);
        }])->get();

        // Calcular porcentajes con solo 2 decimales
        $porcentajeReportado = ($movimientoCount > 0) ? number_format(($serviciosSinCambios / $movimientoCount) * 100, 2) : 0;
        $porcentajeCamasOcupadas = ($camasOperativas > 0) ? number_format(($camasOcupadas / $camasOperativas) * 100, 2) : 0;
        $camasDisponibles = $camasOperativas - $camasOcupadas;
        $porcentajeCamasDisponibles = ($camasOperativas > 0) ? number_format(($camasDisponibles / $camasOperativas) * 100, 2) : 0;

        return view('content.apps.app-camas-region-management', [
            'movimientoCount' => $movimientoCount,
            'camasOperativas' => $camasOperativas,
            'camasOcupadas' => $camasOcupadas,
            'altasUltimas24Horas' => $altasUltimas24Horas,
            'serviciosSinCambios' => $serviciosSinCambios,
            'disponibles' => $disponibles,
            'porcentajeReportado' => $porcentajeReportado,
            'porcentajeCamasOcupadas' => $porcentajeCamasOcupadas,
            'porcentajeCamasDisponibles' => $porcentajeCamasDisponibles,
        ]);
    }



  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
      // public function index(Request $request)
      // {
      //   $columns = [
      //     1 => 'idMovimientoCamas',
      //     2 => 'establecimientoServicio',
      //     3 => 'camasOcupadas',
      //     4 => 'posiblesAltas6Horas',
      //     5 => 'posiblesAltas12Horas',
      //     6 => 'tipoReporte',
      //     7 => 'fechaRegistro'
      //   ];

      //   $search = [];

      //   $totalData = MovimientoCama::count();

      //   $totalFiltered = $totalData;

      //   $limit = $request->input('length');
      //   $start = $request->input('start');
      //   $column = $request->input('column', 0);
      //   $order = $columns[$request->input('order.0.column')];
      //   $dir = $request->input('order.0.dir');


      //   if (empty($request->input('search.value'))) {
      //     $movimientoCamas = MovimientoCama::offset($start)
      //       ->limit($limit)
      //       ->orderBy($order, $dir)
      //       ->get();
      //   } else {
      //     $search = $request->input('search.value');

      //     $movimientoCamas = MovimientoCama::with('establecimientoServicio')
      //       ->where('idMovimientoCamas', 'LIKE', "%{$search}%")
      //       ->orWhere('establecimientoServicio', 'LIKE', "%{$search}%")
      //       ->orWhere('', 'LIKE', "%{$search}%")
      //       ->orWhere('fechaOT', 'LIKE', "%{$search}%")
      //       ->offset($start)
      //       ->limit($limit)
      //       ->orderBy($order, $dir)
      //       ->get();

      //     $totalFiltered = MovimientoCama::where('idOT', 'LIKE', "%{$search}%")
      //       ->orWhere('', 'LIKE', "%{$search}%")
      //       ->orWhere('identidadMovil', 'LIKE', "%{$search}%")
      //       ->orWhere('fechaOT', 'LIKE', "%{$search}%")
      //       ->count();
      //   }

      //   $data = [];

      //   if (!empty($movimientoCamas)) {
      //     // providing a dummy id instead of database ids
      //     $ids = $start;

      //     foreach ($movimientoCamas as $movimientoCama) {
      //       $nestedData['idMovimientoCamas'] = $movimientoCama->idMovimientoCamas;
      //       $nestedData['fake_id'] = ++$ids;
      //       $nestedData['idEst_serv'] = $movimientoCama->establecimientoServicio-> ?? null;


      //       $nestedData['condOT'] = $conductoresNombres;
      //       $nestedData['fechaOT'] = $movimientoCama->fechaOT;
      //       $nestedData['fechaEnviado'] = $movimientoCama->fechaEnviado;
      //       $nestedData['fechaImpreso'] = $movimientoCama->fechaImpreso;
      //       $nestedData['fechaFinalizado'] = $movimientoCama->fechaFinalizado;
      //       $data[] = $nestedData;
      //     }
      //   }

      //   if ($data) {
      //     return response()->json([
      //       'draw' => intval($request->input('draw')),
      //       'recordsTotal' => intval($totalData),
      //       'recordsFiltered' => intval($totalFiltered),
      //       'code' => 200,
      //       'data' => $data,
      //     ]);
      //   } else {
      //     return response()->json([
      //       'message' => 'Internal Server Error',
      //       'code' => 500,
      //       'data' => [],
      //     ]);
      //   }
      // }

      // Mostrar una lista de todos los registros
      public function index()
      {
          $movimientos = MovimientoCamas::all();
          return view('movimiento.index', compact('movimientos'));
      }

      // Mostrar el formulario para crear un nuevo registro
      public function create()
      {
          return view('movimiento.create');
      }

      // Almacenar un nuevo registro en la base de datos
      public function store(Request $request)
      {
          $request->validate([
              'establecimientoServicio' => 'required',
              'camasOcupadas' => 'required',
              'altasUltimas24Horas' => 'required',
              'posiblesAltas6Horas' => 'required',
              'posiblesAltas12Horas' => 'required',
              'tipoReporte' => 'required',
              'fechaRegistro' => 'required',
          ]);

          MovimientoCamas::create($request->all());

          return redirect()->route('movimiento.index')
              ->with('success', 'Registro de movimiento de camas creado con éxito.');
      }

      // Mostrar un registro específico
      public function show(MovimientoCamas $movimientoCama)
      {
          return view('movimiento.show', compact('movimientoCama'));
      }

      // Mostrar el formulario para editar un registro
      public function edit(MovimientoCamas $movimientoCama)
      {
          return view('movimiento.edit', compact('movimientoCama'));
      }

      // Actualizar un registro en la base de datos
      public function update(Request $request, MovimientoCamas $movimientoCama)
      {
          $request->validate([
              'establecimientoServicio' => 'required',
              'camasOcupadas' => 'required',
              'altasUltimas24Horas' => 'required',
              'posiblesAltas6Horas' => 'required',
              'posiblesAltas12Horas' => 'required',
              'fechaRegistro' => 'required',
          ]);

          $movimientoCama->update($request->all());

          return redirect()->route('movimiento.index')
              ->with('success', 'Registro de movimiento de camas actualizado con éxito.');
      }

      // Eliminar un registro de la base de datos
      public function destroy(MovimientoCamas $movimientoCama)
      {
          $movimientoCama->delete();

          return redirect()->route('movimiento.index')
              ->with('success', 'Registro de movimiento de camas eliminado con éxito.');
      }

}

