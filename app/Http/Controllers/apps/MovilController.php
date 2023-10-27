<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Distrito;
use App\Models\Movil;
use App\Models\StatusMovil;
use App\Models\MarcaMovil;
use App\Http\Controllers\Controller;

class MovilController extends Controller
{
    public function index()
    {
        $moviles = Movil::all();

        return view('moviles.index', compact('moviles'));
    }
    public function getMovilesJson() {
      $moviles = Movil::all();
      return response()->json($moviles);
    }


    public function create()
    {
        return view('moviles.create');
    }


    public function store(Request $request)
{
    $request->validate([
        'logo' => 'required|image|mimes:jpeg,png,gif|max:800',
    ]);

    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoName = time() . '.' . $logo->getClientOriginalExtension();
        $logo->move(public_path('assets/img/movilesLogos'), $logoName);

        // Guardar la ruta del logo en la columna "estLogoPath" de la tabla Establecimiento
        $movil = Movil::findOrFail($request->idMovil);
        $movil->marcaLogoPath = $logoName;
        $movil->save();

        return response()->json(['message' => 'Logo almacenado correctamente.']);
    }

    return response()->json(['message' => 'No se ha seleccionado ningún archivo de logo.']);
}

    public function edit(Movil $movil)
    {
        return view('moviles.edit', compact('movil'));
    }

    public function update(Request $request, Movil $movil)
    {
        $movil->update($request->all());

        return redirect()->route('moviles.index')
            ->with('success', 'Móvil actualizado correctamente.');
    }

    public function show($idMovil)
  {
    $movil = Movil::with('marcaMovilFinder')->findOrFail($idMovil);

    $data = [
      'idMovil' => $movil->idMovil,
      'identidadMovil' => $movil->identidadMovil,
      'DistritoName' => $establecimiento->distrito->NombreDistrito,
      'estDistritoID' => $establecimiento->estDistritoID,
      'estRegionID' => $establecimiento->estRegionID,

  ];

  return response()->json($data);

  }


    public function destroy(Movil $movil)
    {
        $movil->delete();

        return redirect()->route('moviles.index')
            ->with('success', 'Móvil eliminado correctamente.');
    }

    public function guardarMovilInfo(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'idMovil' => 'required',
            'identidadMovil' => 'required',
            'chapaMovil' => 'required',
            'marcaMovil' => 'required',
            'tipoMovil' => 'required',
            'modeloMovil' => 'required',
            'baseMovil' => 'required',

        ]);

        // Crear o actualizar el registro en la tabla Establecimiento
        $movil = Movil::updateOrCreate(
            ['idMovil' => $request->idMovil],
            [
                'identidadMovil' => $request->identidadMovil,
                'chapaMovil' => $request->estDistritoID,
                'tipoMovil' => $request->estRegionID,
                'modeloMovil' => $request->estTipo,
                'baseMovil' => $request->estNivel,
                'DATE_CREATED' => now(),
                'DATE_UPDATED' => now(),
            ]
        );

        // Opcional: Realizar alguna acción adicional si es necesario

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Los datos se han guardado correctamente.']);
    }

}


