<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Distrito;
use App\Http\Controllers\Controller;

class CapacidadCamaController extends Controller
{
    // Mostrar una lista de todos los registros
    public function index()
    {
        $capacidades = CapacidadCama::all();
        return view('capacidad.index', compact('capacidades'));
    }

    public function buscarCapacidadesPorEstablecimiento($establecimientoID, $servicioID = null, $regionID = null)
{
    $query = CapacidadCama::where('estID', $establecimientoID);

    // Si se proporciona un servicioID, filtrar por ese servicio
    if ($servicioID !== null) {
        $query->where('servicioID', $servicioID);
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
            'estID' => 'required',
            'servicioID' => 'required',
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
            'estID' => 'required',
            'servicioID' => 'required',
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
}
