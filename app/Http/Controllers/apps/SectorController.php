<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{
    public function index()
    {
        $sectores = Sector::all();
    return response()->json($sectores);
    }

    public function create()
    {
        return view('sectores.create');
    }


    public function edit(Sector $sector)
    {
        return view('sectores.edit', compact('sectores'));
    }


    public function update(Request $request, Sector $sector)
    {
        $sector->update($request->all());

        return redirect()->route('sectores.index')
            ->with('success', 'Sector actualizado correctamente.');
    }


    public function destroy(Sector $sector)
    {
        $sector->delete();

        return redirect()->route('sector.index')
            ->with('success', 'Sector eliminado correctamente.');
    }

    public function getSectores($idEst)
{
    $sectores = Sector::join('establecimiento_sector', 'sectores.idSector', '=', 'establecimiento_sector.sectorID')
                      ->where('establecimiento_sector.estID', $idEst)
                      ->select('sectores.*')
                      ->get();
    return response()->json($sectores);
}


//     public function store(int $idEst, array $sectoresArray)
//     {
//         foreach ($sectoresArray as $sector) {
//             $idSector = $sector['idSector'];
//             $idDepto = $sector['idDepto'];
//             $idSubDepto = $sector['idSubDepto'];

//             // Obtener el objeto Establecimiento correspondiente al ID
//             $establecimiento = Establecimiento::find($idEst);

//             // Comprobar si se ha seleccionado un subdepartamento
//             if ($idSubDepto) {
//                 // Guardar la relación establecimiento-sector-subdepartamento en la tabla sector_subdepartamento
//                 $establecimiento->subdepartamentos()->attach([
//                     $idSubDepto => [
//                         'idSector' => $idSector,
//                         'idDepto' => $idDepto,
//                         'date_created' => now(),
//                         'date_updated' => now()
//                     ]
//                 ]);
//             } else {
//                 // Guardar la relación establecimiento-sector-departamento en la tabla sector_departamento
//                 $establecimiento->departamentos()->attach([
//                     $idDepto => [
//                         'idSector' => $idSector,
//                         'date_created' => now(),
//                         'date_updated' => now()
//                     ]
//                 ]);
//             }
//         }

//         // Responder con una respuesta de éxito (opcional)
//         return response()->json(['success' => true]);
//     }



//     public function getEstructuraSectores($idEst)
// {
//     $sectores = DB::table('establecimiento_sector')
//         ->join('Sectores', 'establecimiento_sector.idSector', '=', 'Sectores.idSector')
//         ->select('establecimiento_sector.idSector', 'Sectores.nombreSector')
//         ->distinct()
//         ->where('idEst', $idEst)
//         ->get();

//     $sectoresData = $sectores->map(function ($sector) {
//         return [
//             'idSector' => $sector->idSector,
//             'nombreSector' => $sector->nombreSector
//         ];
//     });

//     return response()->json(['sectores' => $sectoresData]);
// }


// public function getEstructuraSectoresUnidades($idEst)
// {
//     $unidades = DB::table('sector_unidad')
//         ->join('Departamentos', 'sector_unidad.idDepto', '=', 'Departamentos.idDepto')
//         ->leftJoin('Sub_Departamentos', 'sector_unidad.idSubDepto', '=', 'Sub_Departamentos.idSubDepto')
//         ->join('Sectores', 'sector_unidad.idSector', '=', 'Sectores.idSector')
//         ->select(
//             'sector_unidad.idSector',
//             'sector_unidad.idDepto',
//             'sector_unidad.idSubDepto',
//             DB::raw("CASE WHEN sector_unidad.idSubDepto IS NOT NULL THEN Sub_Departamentos.nombreSubDepto ELSE Departamentos.nombreDepto END AS nombreUnidad"),
//             'Sectores.nombreSector'
//         )
//         ->where('sector_unidad.idEst', $idEst)
//         ->get();

//     $resultados = $unidades->map(function ($unidad) {
//         return [
//             'idSector' => $unidad->idSector,
//             'idDepto' => $unidad->idDepto,
//             'idSubDepto' => $unidad->idSubDepto ?: '',
//             'nombreUnidad' => $unidad->nombreUnidad,
//             'nombreSector' => $unidad->nombreSector
//         ];
//     });

//     return response()->json([
//         'resultados' => $resultados
//     ]);
// }





// public function guardarEstructuraSector(Request $request)
// {
//     // Obtener los datos del formulario
//     $datosFormulario = $request->all();

//     // Obtener el ID del establecimiento
//     $idEst = $datosFormulario['idEst'];

//     error_log('datosFormulario y idEst recuperados');
//     // Iniciar la transacción
//     DB::beginTransaction();

//     try {
//         // Eliminar los registros existentes para el establecimiento en la tabla establecimiento_sector
//         DB::table('establecimiento_sector')
//             ->where('idEst', $idEst)
//             ->delete();

//         // Eliminar los registros existentes para el establecimiento en la tabla sector_unidad
//         DB::table('sector_unidad')
//             ->where('idEst', $idEst)
//             ->delete();

//         // Insertar los nuevos registros en las tablas establecimiento_sector y sector_unidad
//         $establecimientoSectorData = [];
//         $sectorUnidadData = [];

//         foreach ($datosFormulario['pivotData'] as $pivotData) {
//             $idSector = $pivotData['idSector'];
//             $idDeptoArray = $pivotData['idDepto'];
//             $idSubDeptoArray = $pivotData['idSubDepto'];

//             foreach ($idDeptoArray as $index => $idDepto) {
//                 $idSubDepto = $idSubDeptoArray[$index] ?: '';
//                 $establecimientoSectorData[] = [
//                     'idEst' => $idEst,
//                     'idSector' => $idSector,
//                     'idDepto' => $idDepto,
//                     'idSubDepto' => $idSubDeptoArray[$index] ?: null,
//                     'date_created' => now()->toDateTimeString(),
//                     'date_updated' => now()->toDateTimeString(),
//                 ];
//                 $sectorUnidadData[] = [
//                     'idEst' => $idEst,
//                     'idSector' => $idSector,
//                     'idDepto' => $idDepto,
//                     'idSubDepto' => $idSubDeptoArray[$index] ?: null,
//                 ];
//             }
//         }
//         DB::table('establecimiento_sector')->insert($establecimientoSectorData);
//         DB::table('sector_unidad')->insert($sectorUnidadData);

//         // Confirmar los cambios en la base de datos
//         DB::commit();

//         return response()->json(['message' => 'Datos de sectores actualizados con éxito']);
//     } catch (\Exception $e) {
//         DB::rollback();

//         $errorMessage = $e->getMessage();

//         return response()->json(['message' => 'Error al actualizar los datos de sectores', 'error' => $errorMessage]);
//     }
// }



//     // Función auxiliar para formatear los datos de sector_unidad
//     private function formatSectorUnidadData($sectorUnidadData, $idEst)
//     {
//         $formattedData = [];

//         $idSector = $sectorUnidadData['idSector'];
//         $idDeptoArray = $sectorUnidadData['idDepto'];
//         $idSubDeptoArray = $sectorUnidadData['idSubDepto'];

//         foreach ($idDeptoArray as $index => $idDepto) {
//             $formattedData[] = [
//                 'idEst' => $idEst,
//                 'idSector' => $idSector,
//                 'idDepto' => $idDepto,
//                 'idSubDepto' => $idSubDeptoArray[$index] ?: null,
//             ];
//         }

//         return $formattedData;
//     }


}
