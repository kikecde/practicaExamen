<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\ProfFuncion;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class ProfFuncionController extends Controller
{
  public function getProfesionesJson() {
    $ProfFunciones = ProfFuncion::all();
    return response()->json($ProfFunciones);
  }

    public function index()
    {
        $ProfFunciones = ProfFuncion::all();

        return view('proffunciones.index', compact('proffunciones'));
    }

    public function create()
    {
        return view('proffunciones.create');
    }

    public function store(Request $request)
    {
        $proffuncion = ProfFuncion::create($request->all());

        return redirect()->route('proffunciones.index')
            ->with('success', 'Profesión/Función agregada correctamente.');
    }

    public function edit(ProfFuncion $proffuncion)
    {
        return view('proffunciones.edit', compact('proffunciones'));
    }

    public function update(Request $request,ProfFuncion $proffuncion)
    {
        $proffuncion->update($request->all());

        return redirect()->route('proffunciones.index')
            ->with('success', 'Profesión/Función actualizada correctamente.');
    }

    public function destroy(ProfFuncion $proffuncion)
    {
        $proffuncion->delete();

        return redirect()->route('proffunciones.index')
            ->with('success', 'Profesión/Función eliminada correctamente.');
    }
}
