<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Distrito;
use App\Models\Establecimiento;
use App\Models\CapacidadCama;
use App\Models\Servicio;
use App\Models\Region;
use App\Models\Departamento;
use App\Models\MovimientoCama;
use App\Models\EstablecimientoAreaServicioDepartamento;
use App\Http\Controllers\Controller;

class CapacidadCamaController extends Controller
{
    // Mostrar una lista de todos los registros
    public function index()
    {
        $capacidades = CapacidadCama::all();
        return view('capacidad.index', compact('capacidades'));
    }

    public function buscarCapacidadesPorEstablecimiento($establecimientoID, $servID = null, $regionID = null)
{
    $query = CapacidadCama::where('capacidadIdEst', $establecimientoID);

    // Si se proporciona un servID, filtrar por ese servicio
    if ($servID !== null) {
        $query->where('capacidadIdServ', $servID);
    }

    // Si se proporciona un regionID, aplicar el filtro por región
    if ($regionID !== null) {
        // Obtener el establecimiento y luego la región asociada
        $region = Establecimiento::findOrFail($establecimientoID)->region;

        // Filtrar por la región
        $query->where('regionID', $region->idRegion);
    }

    $capacidades = $query->get();

    return view('capacidad.buscar', compact('capacidades'));
}


    // Mostrar el formulario para crear un nuevo registro
    public function create()
    {
        return view('capacidad.create');
    }

    // Almacenar un nuevo registro en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'capacidadIdEst' => 'required',
            'capacidadIdServ' => 'required',
            'capacidadUnidades' => 'required',
        ]);

        CapacidadCama::create($request->all());

        return redirect()->route('capacidad.index')
            ->with('success', 'Capacidad de camas registrada con éxito.');
    }

    // Mostrar un registro específico
    public function show(CapacidadCama $capacidadCama)
    {
        return view('capacidad.show', compact('capacidadCama'));
    }

    // Mostrar el formulario para editar un registro
    public function edit(CapacidadCama $capacidadCama)
    {
        return view('capacidad.edit', compact('capacidadCama'));
    }

    // Actualizar un registro en la base de datos
    public function update(Request $request, CapacidadCama $capacidadCama)
    {
        $request->validate([
            'capacidadIdEst' => 'required',
            'capacidadIdServ' => 'required',
            'capacidadUnidades' => 'required',
        ]);

        $capacidadCama->update($request->all());

        return redirect()->route('capacidad.index')
            ->with('success', 'Capacidad de camas actualizada con éxito.');
    }

    // Eliminar un registro de la base de datos
    public function destroy(CapacidadCama $capacidadCama)
    {
        $capacidadCama->delete();

        return redirect()->route('capacidad.index')
            ->with('success', 'Capacidad de camas eliminada con éxito.');
    }

    public function filtrarCapacidades($idEst, $idEst_Area_Serv_Depto = null)
    {
        // Iniciar la consulta con filtro por establecimiento
        $query = CapacidadCama::where('capacidadIdEst', $idEst);

        // Filtrar por servicio si se proporciona
        // if (!is_null($servID)) {
        //     $query->where('capacidadIdServ', $servID);
        // }

        // Filtrar por departamento si se proporciona
        if (!is_null($idEst_Area_Serv_Depto)) {
            $query->where('capacidadEst_Area_Serv_DeptoID', $idEst_Area_Serv_Depto);
        }

        // Obtener los resultados de la consulta
        $capacidades = $query->get();

        // Devolver una vista o respuesta JSON con los resultados
        // return view('tu_vista', compact('capacidades'));
        return response()->json(['capacidades' => $capacidades]);
    }




}
