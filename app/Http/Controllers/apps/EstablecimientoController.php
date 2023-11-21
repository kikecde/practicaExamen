<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Region;
use App\Models\Estudio;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\Sector;
use App\Models\Departamento;
use App\Models\DepartamentoNoMed;
use App\Models\Distrito;
use App\Models\EstablecimientoArea;
use App\Models\EstablecimientoAreaServicio;
use App\Models\EstablecimientoAreaServicioDepartamento;
use App\Models\EstablecimientoAreaServicioDepartamentoSector;
use App\Models\EstablecimientoAreaDepartamentoNoMed;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EstablecimientoController extends Controller
{
    public function index()
    {
        $establecimientos = Establecimiento::all();

        return view('establecimientos.index', compact('establecimientos'));
    }
    public function getEstablecimientosJson() {
      $establecimientos = Establecimiento::all();
      return response()->json($establecimientos);
    }


    public function create()
    {
        return view('establecimientos.create');
    }


    public function store(Request $request)
{
    $request->validate([
        'logo' => 'required|image|mimes:jpeg,png,gif|max:800',
    ]);

    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoName = time() . '.' . $logo->getClientOriginalExtension();
        $logo->move(public_path('assets/img/estabsLogos'), $logoName);

        // Guardar la ruta del logo en la columna "estLogoPath" de la tabla Establecimiento
        $establecimiento = Establecimiento::findOrFail($request->idEst);
        $establecimiento->estLogoPath = $logoName;
        $establecimiento->save();

        return response()->json(['message' => 'Logo almacenado correctamente.']);
    }

    return response()->json(['message' => 'No se ha seleccionado ningún archivo de logo.']);
}

    public function edit(Establecimiento $establecimiento)
    {
        return view('establecimientos.edit', compact('establecimiento'));
    }

    public function update(Request $request, Establecimiento $establecimiento)
    {
        $establecimiento->update($request->all());

        return redirect()->route('establecimientos.index')
            ->with('success', 'Establecimiento actualizado correctamente.');
    }

    public function show($idEst)
  {
    $establecimiento = Establecimiento::with('distrito')->findOrFail($idEst);

    $data = [
      'idEst' => $establecimiento->idEst,
      'NombreEstablecimiento' => $establecimiento->NombreEstablecimiento,
      'DistritoName' => $establecimiento->distrito->NombreDistrito,
      'estDistritoID' => $establecimiento->estDistritoID,
      'estRegionID' => $establecimiento->estRegionID,
      'estTipo' => $establecimiento->estTipo,
      'estNivel' => $establecimiento->estNivel,
      'estAbrev' => $establecimiento->estAbrev,
      'estTelefono' => $establecimiento->estTelefono,
      'estMail' => $establecimiento->estMail,
      'estLogoPath' => $establecimiento->estLogoPath,
      'estUbicacionLatitud' => $establecimiento->estUbicacion,
      'estUbicacionLongitud' => $establecimiento->estUbicacion
  ];

  return response()->json($data);

  }


    public function destroy(Establecimiento $establecimiento)
    {
        $establecimiento->delete();

        return redirect()->route('establecimientos.index')
            ->with('success', 'Establecimiento eliminado correctamente.');
    }

    public function guardarEstabInfo(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'idEst' => 'required',
            'NombreEstablecimiento' => 'required',
            'estDistritoID' => 'required',
            'estRegionID' => 'required',
            'estTipo' => 'required',
            'estNivel' => 'required',
            'estAbrev' => 'required',

        ]);

        // Crear o actualizar el registro en la tabla Establecimiento
        $establecimiento = Establecimiento::updateOrCreate(
            ['idEst' => $request->idEst],
            [
                'NombreEstablecimiento' => $request->NombreEstablecimiento,
                'estDistritoID' => $request->estDistritoID,
                'estRegionID' => $request->estRegionID,
                'estTipo' => $request->estTipo,
                'estNivel' => $request->estNivel,
                'estAbrev' => $request->estAbrev,
                'estUbicacionLatitud' => $request->estUbicacionLatitud,
                'estUbicacionLongitud' => $request->estUbicacionLongitud,

            ]
        );

        // Opcional: Realizar alguna acción adicional si es necesario

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Los datos se han guardado correctamente.']);
    }






    public function getEstructuraEstablecimiento($idEst)
  {

        // Recuperar el establecimiento con todas sus relaciones anidadas.
        $estructuraEstablecimiento = Establecimiento::with([
            'areas.servicios.departamentos.sectores',
            'areas.departamentosNoMed'
        ])->find($idEst);

        // Almacenar la estructura en el almacenamiento provisional.
        // El almacenamiento provisional puede ser una sesión, caché, etc.
        // El 'key' debe ser único por establecimiento y por usuario, para evitar colisiones.
        $key = "establecimiento.{$idEst}.estructura";
        Cache::put($key, $estructuraEstablecimiento, now()->addMinutes(30)); // Almacenar por 30 minutos, por ejemplo.

        // Devolver la estructura completa del establecimiento.
        return response()->json($estructuraEstablecimiento);
    }



//     public function getDataEstablecimiento($idEst = null)
// {
//     \Log::info("Iniciando getDataEstablecimiento con idEst: {$idEst}");
//     $estabDetalles = [];
//     $estabDetallesServicios = [];

//     if ($idEst) {
//         $estabDetalles = Establecimiento::with(['areas' => function($query) {
//                                     $query->withPivot('idEst_Area');
//                                 }])
//                                 ->find($idEst);

//         if ($estabDetalles) {
//             foreach ($estabDetalles->areas as $area) {
//                 \Log::info('Procesando área: ', ['idArea' => $area->idArea, 'NombreArea' => $area->NombreArea]);

//                 if ($area->idArea == 1) { // Si el área es "MEDICA"
//                     // Encontrar las relaciones entre el establecimiento y el área médica
//                     $establecimientoAreaId = $area->pivot->idEst_Area;
//                     \Log::info("ID de relación Establecimiento-Área Médica: {$establecimientoAreaId}");

//                     // Recuperar los IDs de los servicios para el área médica
//                     $serviciosIds = EstablecimientoAreaServicio::where('est_AreaID', $establecimientoAreaId)
//                                         ->pluck('servID')->toArray();
//                     \Log::info('IDs de servicios obtenidos: ', $serviciosIds);

//                     if (!empty($serviciosIds)) {
//                         $servicios = Servicio::whereIn('idServ', $serviciosIds)->get();
//                         \Log::info('Servicios recuperados: ', $servicios->toArray());

//                         $estabDetallesServicios = [
//                             'idArea' => $area->idArea,
//                             'NombreArea' => $area->NombreArea,
//                             'servicios' => $servicios
//                         ];
//                     } else {
//                         \Log::info('No se encontraron IDs de servicios para el área médica.');
//                     }
//                 }
//             }
//         }
//     }

//     return response()->json(['estabDetalles' => $estabDetalles, 'estabDetallesServicios' => $estabDetallesServicios]);
// }

    public function getDataEstablecimiento($idEst = null)
{
    $estabDetalles = [];
    $estabDetallesEstructura = ['areas' => []]; // Inicializando con una clave "areas"

    if ($idEst) {
        $estabDetalles = Establecimiento::with(['areas' => function($query) {
                            $query->withPivot('idEst_Area');
                          }])
                          ->find($idEst);

        if ($estabDetalles) {
          foreach ($estabDetalles->areas as $area) {
            if ($area->idArea == 1) {
              $establecimientoAreaId = $area->pivot->idEst_Area;

              $establecimientoAreaServicios = EstablecimientoAreaServicio::where('est_AreaID', $establecimientoAreaId)
                  ->get(['idEst_Area_Serv', 'servID']);

              foreach ($establecimientoAreaServicios as $eas) {
                $departamentoPivots = EstablecimientoAreaServicioDepartamento::where('est_Area_ServID', $eas->idEst_Area_Serv)
                  ->get();

                foreach ($departamentoPivots as $departamentoPivot) {
                  $sectoresIds = EstablecimientoAreaServicioDepartamentoSector::where('est_Area_Serv_DeptoID', $departamentoPivot->idEst_Area_Serv_Depto)
                              ->pluck('sectorID')->toArray();

                  $departamento = Departamento::find($departamentoPivot->deptoID);
                  $departamento->sectores = Sector::whereIn('idSector', $sectoresIds)->get();
                  $departamentoPivot->departamento = $departamento;
                }

                  $eas->servicio = Servicio::find($eas->servID);
                  $eas->servicio->departamentos = $departamentoPivots->pluck('departamento');
              }

              $area->servicios = $establecimientoAreaServicios->pluck('servicio');


              foreach ($area->servicios as $servicio) {

                $pivotServicio = EstablecimientoAreaServicio::where('est_AreaID', $area->pivot->idEst_Area)
                                    ->where('servID', $servicio->idServ)
                                    ->first();

                  if ($pivotServicio) {
                    $servicio->pivot = [
                        'est_AreaID' => $area->pivot->idEst_Area,
                        'servID' => $servicio->idServ,
                        'idEst_Area_Serv' => $pivotServicio->idEst_Area_Serv
                    ];
                  } else {
                      continue;
                  }

                  // Añadir el pivot a cada departamento
                  foreach ($servicio->departamentos as $departamento) {

                    $pivotDepartamento = EstablecimientoAreaServicioDepartamento::where('est_Area_ServID', $pivotServicio->idEst_Area_Serv)
                                            ->where('deptoID', $departamento->idDepto)
                                            ->first();
                    $departamento->pivot = [
                        'est_Area_ServID' => $pivotServicio->idEst_Area_Serv,
                        'deptoID' => $departamento->idDepto,
                        'idEst_Area_Serv_Depto' => $pivotDepartamento->idEst_Area_Serv_Depto ?? null
                    ];

                    // Añadir el pivot a cada sector
                    foreach ($departamento->sectores as $sector) {

                        $pivotSector = EstablecimientoAreaServicioDepartamentoSector::where('est_Area_Serv_DeptoID', $pivotDepartamento->idEst_Area_Serv_Depto)
                                            ->where('sectorID', $sector->idSector)
                                            ->first();
                        $sector->pivot = [
                            'est_Area_Serv_DeptoID' => $pivotDepartamento->idEst_Area_Serv_Depto,
                            'sectorID' => $sector->idSector,
                            'idEst_Area_Serv_Depto_Sector' => $pivotSector->idEst_Area_Serv_Depto_Sector ?? null
                        ];
                    }
                  }
              }

            } else {
                // Procesar las áreas no médicas
                $establecimientoAreaId = $area->pivot->idEst_Area;


                $deptosNoMed = EstablecimientoAreaDepartamentoNoMed::where('est_AreaID', $establecimientoAreaId)
                            ->get();

                $departamentosNoMed = [];
                foreach ($deptosNoMed as $deptoNoMed) {
                    $departamentoNoMed = DepartamentoNoMed::find($deptoNoMed->deptoNoMedID);
                    if ($departamentoNoMed) {
                      $departamentoNoMed->pivot = [
                        'est_AreaID' => $establecimientoAreaId,
                        'deptoNoMedID' => $departamentoNoMed->idDeptoNoMed,
                        'idEst_Area_DeptoNoMed' => $deptoNoMed->idEst_Area_DeptoNoMed
                      ];
                        $departamentosNoMed[] = $departamentoNoMed;
                    }
                }

                $area->departamentosNoMed = $departamentosNoMed;
            }



              // Añadiendo la estructura completa de cada área a $estabDetallesEstructura bajo la clave "areas"
              $estabDetallesEstructura['areas'][] = $area;
          }
        }
    }

    return response()->json(['estabDetalles' => $estabDetalles, 'estabDetallesEstructura' => $estabDetallesEstructura]);

  }














//     public function getDataEstablecimiento($idEst = null)
// {
//     $estabDetalles = [];
//     $estabData = [];

//     if ($idEst) {
//         $estabDetalles = Establecimiento::with([
//             'areas' => function ($query) use ($idEst) {
//                 $query->with([
//                     'servicios' => function ($query) use ($idEst) {
//                         $query->whereHas('establecimientos', function ($query) use ($idEst) {
//                             $query->where('idEst', $idEst);
//                         })->with([
//                             'departamentos' => function ($query) {
//                                 $query->with('sectores');
//                             }
//                         ]);
//                     },
//                     'departamentosNoMed'
//                 ]);
//             }
//         ])->find($idEst);

//         if ($estabDetalles) {
//             $estabData = $estabDetalles->areas->map(function ($area) {
//                 $areaData = $area->toArray();
//                 $areaData['esAreaMedica'] = ($area->idArea == 1);

//                 if ($area->idArea == 1) {
//                     $areaData['servicios'] = $area->servicios->map(function ($servicio) {
//                         $servicioData = $servicio->toArray();
//                         $servicioData['departamentos'] = $servicio->departamentos->map(function ($departamento) {
//                             $departamentoData = $departamento->toArray();
//                             $departamentoData['sectores'] = $departamento->sectores;
//                             return $departamentoData;
//                         });
//                         return $servicioData;
//                     });
//                 } else {
//                     $areaData['departamentosNoMed'] = $area->departamentosNoMed;
//                 }

//                 return $areaData;
//             });
//         }
//     }

//     return response()->json(['estabData' => $estabData, 'estabDetalles' => $estabDetalles]);
// }







    // public function getDataEstablecimiento($idEst = null)
    // {
    //     $estabDetalles = [];
    //     $estabData = [];

    //     if ($idEst) {
    //       $estabDetalles = Establecimiento::find($idEst);
    //         // Obtener los sectores asociados al establecimiento con sus relaciones
    //         $estabData = Sector::join('establecimiento_area_servicio_departamento_sector', 'sectores.idSector', '=', 'establecimiento_area_servicio_departamento_sector.sectorID')
    //             ->join('establecimiento_area_servicio_departamento', 'establecimiento_area_servicio_departamento.idEst_Area_Serv_Depto', '=', 'establecimiento_area_servicio_departamento_sector.est_Area_Serv_DeptoID')
    //             ->join('departamentos', 'establecimiento_area_servicio_departamento.deptoID', '=', 'departamentos.idDepto')
    //             ->join('establecimiento_area_servicio', 'establecimiento_area_servicio_departamento.est_Area_ServID', '=', 'establecimiento_area_servicio.idEst_Area_Serv')
    //             ->join('servicios', 'establecimiento_area_servicio.servID', '=', 'servicios.idServ')
    //             ->join('establecimiento_area', 'establecimiento_area_servicio.est_AreaID', '=', 'establecimiento_area.idEst_Area')
    //             ->join('areas', 'establecimiento_area.areaID', '=', 'areas.idArea')

    //             ->select(
    //                 'sectores.*',
    //                 'departamentos.idDepto as deptoID',
    //                 'departamentos.NombreDepto as NombreDepto',
    //                 'servicios.idServ as servID',
    //                 'servicios.NombreServ as NombreServ',
    //                 'areas.idArea as areaID',
    //                 'areas.NombreArea as NombreArea',
    //                 'establecimiento_area_servicio_departamento_sector.idEst_Area_Serv_Depto_Sector as est_Area_Serv_Depto_SectorID',
    //                 'establecimiento_area_servicio_departamento.idEst_Area_Serv_Depto as est_Area_Serv_DeptoID',
    //             )
    //             ->where('establecimiento_area.estID', $idEst)
    //             ->get();
    //     }

    //     return response()->json(['estabData' => $estabData, 'estabDetalles' => $estabDetalles]);
    // }




}


