<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Distrito;
use App\Models\ConfiguraCobertura;
use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Cobertura;



class CoberturaController extends Controller
{
  public function getConfiguracionesPorRegion(Request $request, $idRegion, $tipoCobertura)
  {
      $configuraciones = ConfiguraCobertura::where('id_region', $idRegion)
          ->where('distancia_clasificacion', $tipoCobertura)
          ->with(['distrito.region']) // Cargar relaciones para obtener nombres de distritos y regiones
          ->get();

      return response()->json($configuraciones);
  }

}
