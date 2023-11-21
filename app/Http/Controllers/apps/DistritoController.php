<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Distrito;
use App\Http\Controllers\Controller;

class DistritoController extends Controller
{
    public function index()
    {
        $distritos = Distrito::all();
    //dd($distritos);

    return view('distritos.index', compact('distritos'));
    }

    public function getDistritosJson($regionID = null)
    {
        if ($regionID) {
            $distritos = Distrito::where('regionID', $regionID)->get();
        } else {
            $distritos = Distrito::all();
        }

        return response()->json($distritos);
    }



    public function create()
    {
        return view('distritos.create');
    }

    public function store(Request $request)
    {
        $distrito = Distrito::create($request->all());

        return redirect()->route('distritos.index')
            ->with('success', 'Distrito creado correctamente.');
    }

    public function edit(Distrito $distrito)
    {
        return view('distritos.edit', compact('distritos'));
    }

    public function update(Request $request, Distrito $distrito)
    {
        $distrito->update($request->all());

        return redirect()->route('distritos.index')
            ->with('success', 'Distrito actualizado correctamente.');
    }

    public function destroy(Distrito $distrito)
    {
        $distrito->delete();

        return redirect()->route('distritos.index')
            ->with('success', 'Distrito eliminado correctamente.');
    }
}
