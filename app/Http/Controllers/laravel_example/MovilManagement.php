<?php

namespace App\Http\Controllers\laravel_example;

use App\Http\Controllers\Controller;
use App\Models\Establecimiento;
use Illuminate\Http\Request;
use App\Models\Movil;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MovilManagement extends Controller
{
  public function getMovilesJson(Request $request) {
    $operativos = $request->input('operativos');
    if ($operativos) {
        $moviles = Movil::whereHas('statusMovil', function ($query) {
            $query->where('statusOperativo', 4)->orWhere('statusOperativo', 5);
        })->get();
    } else {
        $moviles = Movil::all();
    }
    return response()->json($moviles);
}

    public function getMovilData(Request $request) {
      $movil_id = $request->input('movil_id');
      $movil = Movil::with(['marcaMovilFinder', 'establecimiento.distrito'])->find($movil_id);
      return response()->json($movil);
    }




  public function MovilManagement()
  {
    $moviles = Movil::with('statusMovil')->get(); // Precarga la relación para optimizar las consultas
    $movilesCount = $moviles->count();

    $operativo = $moviles->filter(function ($movil) {
        return !is_null($movil->statusMovil) && ($movil->statusMovil->statusOperativo == 4 || $movil->statusMovil->statusOperativo == 5);
    })->count();

    $operativoLimitado = $moviles->filter(function ($movil) {
        return !is_null($movil->statusMovil) && ($movil->statusMovil->statusOperativo == 2 || $movil->statusMovil->statusOperativo == 3);
    })->count();

    $inoperativo = $moviles->filter(function ($movil) {
        return is_null($movil->statusMovil) || $movil->statusMovil->statusOperativo == 0 || $movil->statusMovil->statusOperativo == 1;
    })->count();

    $movilesActivos = $moviles->filter(function ($movil) {
        return !is_null($movil->statusMovil) && ($movil->statusMovil->statusActivo >= 2 && $movil->statusMovil->statusActivo <= 5);
    })->count();

    $movilesStandBy = $moviles->filter(function ($movil) {
        return !is_null($movil->statusMovil) && ($movil->statusMovil->statusActivo == 0 || $movil->statusMovil->statusActivo == 1);
    })->count();

    $operativoLastUpdate = Movil::whereHas('statusMovil', function ($query) {
      $query->where('statusOperativo', '>', 1);
  })->with('statusMovil')->get()->min('statusMovil.LAST_UPDATE');

  $operativoLastUpdate = Carbon::parse($operativoLastUpdate)->format('d/m/Y H:i:s');

  $noOperativoLastUpdate = Movil::whereHas('statusMovil', function ($query) {
      $query->whereIn('statusOperativo', [0, 1]);
  })->with('statusMovil')->get()->min('statusMovil.LAST_UPDATE');

  $noOperativoLastUpdate = Carbon::parse($noOperativoLastUpdate)->format('d/m/Y H:i:s');



    $operativoTotal = $operativo + $operativoLimitado;
    $porcentajeOperativo = ($movilesCount > 0) ? ($operativo / $movilesCount) * 100 : 0;
    $porcentajeOperativoLimitado = ($movilesCount > 0) ? ($operativoLimitado / $movilesCount) * 100 : 0;
    $porcentajeInoperativo = ($movilesCount > 0) ? ($inoperativo / $movilesCount) * 100 : 0;
    $porcentajeActivo = ($movilesCount > 0) ? ($movilesActivos / $movilesCount) * 100 : 0;
    $porcentajeStandby = ($movilesCount > 0) ? ($movilesStandBy / $movilesCount) * 100 : 0;

    $establecimientos = Establecimiento::all();



    return view('content.laravel-example.movil-management', [
      'totalMovil' => $movilesCount,
      'operativo' => $operativo,
      'operativoTotal' => $operativoTotal,
      'operativoLimitado' => $operativoLimitado,
      'inoperativo' => $inoperativo,
      'movilesActivos' => $movilesActivos,
      'movilesStandBy' => $movilesStandBy,
      'operativoTotal' => $operativoTotal,
      'porcentajeOperativo' => $porcentajeOperativo,
      'porcentajeOperativoLimitado' => $porcentajeOperativoLimitado,
      'porcentajeInoperativo' => $porcentajeInoperativo,
      'porcentajeActivo' => $porcentajeActivo,
      'porcentajeStandby' => $porcentajeStandby,
      'operativoLastUpdate' => $operativoLastUpdate,
      'noOperativoLastUpdate' => $noOperativoLastUpdate,
      'establecimientos' => $establecimientos
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
      1 => 'idMovil',
      2 => 'identidadMovil',
      3 => 'chapaMovil',
      4 => 'baseMovil',
      5 => 'marcaMovil',
      6 => 'tipoAmbulancia',
    ];


    $search = [];

    $totalData = Movil::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $moviles = Movil::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');

      $moviles = Movil::with('statusMovil')
        ->where('idMovil', 'LIKE', "%{$search}%")
        ->orWhere('identidadMovil', 'LIKE', "%{$search}%")
        ->orWhere('chapaMovil', 'LIKE', "%{$search}%")
        ->orWhere('baseMovil', 'LIKE', "%{$search}%")
       // ->orWhere('marcaMovil', 'LIKE', "%{$search}%")
       // ->orWhere('tipoAmbulancia', 'LIKE', "%{$search}%")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = Movil::where('idMovil', 'LIKE', "%{$search}%")
        ->orWhere('identidadMovil', 'LIKE', "%{$search}%")
        ->orWhere('chapaMovil', 'LIKE', "%{$search}%")
        ->orWhere('baseMovil', 'LIKE', "%{$search}%")
        // ->orWhere('marcaMovil', 'LIKE', "%{$search}%")
        // ->orWhere('tipoAmbulancia', 'LIKE', "%{$search}%")
        ->count();
    }

    $data = [];

    if (!empty($moviles)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($moviles as $movil) {
        $nestedData['idMovil'] = $movil->idMovil;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['identidadMovil'] = $movil->identidadMovil;
        $nestedData['chapaMovil'] = $movil->chapaMovil;
        $nestedData['baseMovil'] = $movil->baseMovil;
        $nestedData['tipoAmbulancia'] = $movil->tipoAmbulancia;
        $nestedData['statusOperativo'] = $movil->statusMovil ? $movil->statusMovil->statusOperativo : null;
        $nestedData['statusActivo'] = $movil->statusMovil ? $movil->statusMovil->statusActivo : null;
        $nestedData['marcaMovilNombre'] = $movil->marcaMovilFinder ? $movil->marcaMovilFinder->nombreMarcaMovil : null;
        $nestedData['marcaLogo'] = $movil->marcaMovilFinder ? $movil->marcaMovilFinder->marcaLogoPath : null;
        $nestedData['tipoAmbuIcon'] = $movil->tipoAmbulancia ? $movil->tipoAmbulancia->tipoAmbuIcon : null;
        $nestedData['statusSaldo'] = $movil->statusMovil ? $movil->statusMovil->statusSaldo : null;
        $nestedData['lastUpdate'] = $movil->statusMovil ? $movil->statusMovil->LAST_UPDATE : null;


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

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $movilID = $request->idMovil;

    if ($movilID) {
      // update the value
      $moviles = Movil::updateOrCreate(
        ['idMovil' => $movilID],
        ['identidadMovil' => $request->identidadMovil,
        'chapaMovil' => $request->chapaMovil,
        'chasisMovil' => $request->chasisMovil,
        'marcaMovil' => $request->marcaMovil,
        'modeloMovil' => $request->modeloMovil,
        'tipoMovil' => $request->tipoMovil,
        'yearMovil' => $request->yearMovil,
        'motorMovil' => $request->motorMovil,
        'capacidadTanque' => $request->capacidadTanque,
        'tipoAmbulancia' => $request->tipoAmbulancia,
        'raspMovil' => $request->raspMovil,
        'nroOrdenMovil' => $request->nroOrdenMovil,
        'baseMovil' => $request->baseMovil,
        'aseguradoraMovil' => $request->aseguradoraMovil,
        'agenteSeguroMovil' => $request->agenteSeguroMovil,
        'telAgenteSeguro' => $request->telAgenteSeguro,
        'mailAseguradora' => $request->mailAseguradora,
        'polizaNroMovil' => $request->polizaNroMovil,
        'vencimientoPolizaMovil' => $request->vencimientoPolizaMovil,
        'tarjetaPETROPAR' => $request->tarjetaPETROPAR]
      );

      // movil updated
      return response()->json('Updated');
    } else {
      // create new one if chapa is unique
      $chapaMovilUnico = Movil::where('chapaMovil', $request->chapaMovil)->first();

      if (empty($chapaMovilUnico)) {
        $moviles = Movil::updateOrCreate(
          ['idMovil' => $movilID],
          ['identidadMovil' => $request->identidadMovil,
            'chapaMovil' => $request->chapaMovil,
            'chasisMovil' => $request->chasisMovil,
            'marcaMovil' => $request->marcaMovil,
            'modeloMovil' => $request->modeloMovil,
            'tipoMovil' => $request->tipoMovil,
            'yearMovil' => $request->añoMovil,
            'motorMovil' => $request->motorMovil,
            'capacidadTanque' => $request->capacidadTanque,
            'tipoAmbulancia' => $request->tipoAmbulancia,
            'raspMovil' => $request->raspMovil,
            'nroOrdenMovil' => $request->nroOrdenMovil,
            'baseMovil' => $request->baseMovil,
            'aseguradoraMovil' => $request->aseguradoraMovil,
            'agenteSeguroMovil' => $request->agenteSeguroMovil,
            'telAgenteSeguro' => $request->telAgenteSeguro,
            'mailAseguradora' => $request->mailAseguradora,
            'polizaNroMovil' => $request->polizaNroMovil,
            'vencimientoPolizaMovil' => $request->vencimientoPolizaMovil,
            'tarjetaPETROPAR' => $request->tarjetaPETROPAR]
          );


        // movil created
        return response()->json('Movil nuevo creado');
      } else {
        // movil already exist
        return response()->json(['message' => "already exits"], 422);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $where = ['idMovil' => $id];

    $moviles = Movil::where($where)->first();

    return response()->json($moviles);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $moviles = Movil::where('idMovil', $id)->delete();
  }
}


