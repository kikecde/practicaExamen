<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Distrito;
use App\Http\Controllers\Controller;

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
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Opcional: Realizar alguna acción adicional si es necesario

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Los datos se han guardado correctamente.']);
    }

}


