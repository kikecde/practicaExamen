<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\FuncionarioVinculo;
use App\Http\Controllers\Controller;

class FuncionarioVinculoController extends Controller
{
    public function index()
    {
        $funcionarios_vinculos = FuncionarioVinculo::all();

        return view('funcionarios_vinculos.index', compact('funcionarios_vinculos'));
    }

    public function create()
    {
        return view('funcionarios_vinculos.create');
    }

    public function store(Request $request)
    {
   // $idFuncionario = $request->input('idFunc');

   $funcionario_vinculo = FuncionarioVinculo::create($request->all());

  // $datosFuncionarioVinculo = [

   // $funcionario_vinculo = FuncionarioVinculo::create([
     //   'FuncsID' => $request->input('OrdenVinculo'),
     //   'OrdenVinculo' => $request->input('OrdenVinculo'),
     //   'InstitVinc' => $request->input('InstitVinc'),
     //   'VincTipoMSPBS' => $request->input('VincTipoMSPBS'),
     //   'HorasVinc' => $request->input('HorasVinc'),
     //   'funcVincEstab' => $request->input('funcVincEstab'),
     //   'fechaAltaVinc' => $request->input('fechaAltaVinc'),
     //   'funcCI' => $request->input('funcCI'),
    //]);

    return view('content.apps.app-user-list')
        ->with('success', 'Vinculo de Funcionario creado correctamente.');
    }


    public function getVinculosByFuncionario($idFuncionario)
{
    $funcionario = Funcionario::findOrFail($idFuncionario);
    $vinculos = $funcionario->vinculos()->with(['institucion', 'ordenVinculo', 'tipoVinculo', 'establecimiento'])->get();

    return response()->json([
        'success' => true,
        'vinculos' => $vinculos
    ]);
}



    public function edit(FuncionarioVinculo $funcionario_vinculo)
    {
        return view('funcionarios_vinculos.edit', compact('funcionarios_vinculos'));
    }

    public function update(Request $request, FuncionarioVinculo $funcionario_vinculo)
    {
        $funcionario_vinculo->update($request->all());

        return redirect()->route('funcionarios_vinculos.index')
            ->with('success', 'Vinculo de Funcionario actualizado correctamente.');
    }

    public function destroy(FuncionarioVinculo $funcionario_vinculo)
    {
        $funcionario_vinculo->delete();

        return redirect()->route('funcionarios_vinculos.index')
            ->with('success', 'Vinculo de Funcionario eliminado correctamente.');
    }
}
