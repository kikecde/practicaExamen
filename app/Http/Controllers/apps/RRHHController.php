<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\FuncionSEME;



class RRHHController extends Controller
{
    public function PSXManagement()
    {
      $funcionarios = PSX::all();
      $funcionarioCount = $funcionarios->count();
      $verified = PSX::whereNotNull('idUser')->get()->count();
      $notVerified = PSX::whereNull('idUser')->get()->count();
      $funcionariosUnique = $funcionarios->unique(['ciPSX']);
      $funcionarioDuplicates = $funcionarios->diff($funcionariosUnique)->count();
      $noMail = PSX::whereNull('mailPSX')->count();
    //calculos de porcentajes
      $verifiedPercentage = intval(($verified / $funcionarioCount) * 100);

      return view('content.laravel-example.funcionario-management', [
        'totalFuncionario' => $funcionarioCount,
        'verified' => $verified,
        'verifiedPercentage' => $verifiedPercentage,
        'notVerified' => $notVerified,
        'funcionarioDuplicates' => $funcionarioDuplicates,
        'noMail' => $noMail,
      ]);
    }


   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

    public function index(Request $request)
    {
        $columns = [
          1 => 'idPSX',
          2 => 'ciPSX',
          3 => 'nYaPSX',
          4 => 'sexoPSX',
          5 => 'fnacPSX',
          6 => 'profPSX',
          7 => 'mailPSX',
          8 => 'telPSX',
          9 => 'domicilioPSX',
          10 => 'baseOpPSX',
          11 => 'regCondTipoPSX',
          12 => 'regCondNroPSX',
          13 => 'bloodPSX',
          14 => 'seguroPSX',
          15 => 'appPSX',
          16 => 'contactoUrgPSX',
          17 => 'contactoUrgTelPSX',
          18 => 'DATE_CREATED',
          19 => 'DATE_UPDATED',
          20 => 'idFuncionPSX',
          21 => 'foto_pathPSX',
          22 => 'IdUser',
        ];

        $search = [];

        $totalData = PSX::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
          $funcionarios = PSX::offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
            $search = $request->input('search.value');

            $idFuncionPSX = FuncionSEME::where('nombreFuncion', 'LIKE', "%{$search}%")->pluck('idFuncion')->toArray();

          $funcionarios = PSX::where('idPSX', 'LIKE', "%{$search}%")
            ->orWhere('nYaPSX', 'LIKE', "%{$search}%")
            ->orWhere('ciPSX', 'LIKE', "%{$search}%")
            ->orWhereIn('idFuncionPSX', $idFuncionPSX)
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

          $totalFiltered = PSX::where('idPSX', 'LIKE', "%{$search}%")
            ->orWhere('nYaPSX', 'LIKE', "%{$search}%")

            ->orWhere('ciPSX', 'LIKE', "%{$search}%")
            ->orWhereIn('funcProfesion_funcion', $idFuncionPSX)
            ->count();
        }

        $data = [];

        if (!empty($funcionarios)) {
          // crear un "dummy id" en vez del id de la DB
          $ids = $start;

            //preparacion de algunos datos

          $idFuncionPSX = $funcionarios->pluck('funcProfesion_funcion')->toArray();
          $profFunciones = FuncionSEME::whereIn('idProfFunc', $idFuncionPSX)
            ->get()
            ->pluck('NombProfes', 'idProfFunc')
            ->toArray();



          foreach ($funcionarios as $funcionario) {
            $nestedData['nYaPSX'] = $funcionario->nYaPSX;
            $nestedData['idPSX'] = $funcionario->IdFunc;
            $nestedData['fake_id'] = ++$ids;
            $nestedData['ciPSX'] = $funcionario->ciPSX;
            $nestedData['telPSX'] = $funcionario->telPSX;

            $profFuncId = $funcionario->funcProfesion_funcion;
            $profFuncName = $profFunciones[$profFuncId] ?? '';
            $nestedData['funcProfesion_funcion'] = $profFuncName;
            $nestedData['funcProfesion_funcionId'] = $profFuncId;

            $nestedData['idUser'] = $funcionario->idUser;


            $data[] = $nestedData;
          }
        }

        if ($data) {
          return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'code' => 200,
            'data' => $data,
          ]);
        } else {
          return response()->json([
            'message' => 'Internal Server Error',
            'code' => 500,
            'data' => [],
          ]);
        }
      }

    public function show($IdFunc)
{
    $funcionario = PSX::with(['distritos', 'profesiones', 'especialidades'])
    ->find($IdFunc);


    if (!$funcionario) {
        return response()->json(['error' => 'Funcionario no encontrado'], 404);
    }

    if ($funcionario->profesiones) {
        $funcionario->funcProfesion_funcion = $funcionario->profesiones->NombProfes;
    } else {
        $funcionario->funcProfesion_funcion = null;
    }

    if ($funcionario->especialidades) {
        $funcionario->funcEspecialidad = $funcionario->especialidades->NameEspecialidadMed;
    } else {
        $funcionario->funcEspecialidad = null;
    }

    return response()->json(['success' => true, 'funcionario' => $funcionario]);
}

    public function create()
    {
        return view('funcionarios.create');
    }


    public function storeFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,gif|max:800',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('assets/img/estabsLogos'), $fotoName);

            // Guardar la ruta del logo en la columna "estLogoPath" de la tabla Establecimiento
            $funcionario = PSX::findOrFail($request->IdFunc);
            $funcionario->profile_photo_path = $fotoName;
            $funcionario->save();

            return response()->json(['message' => 'Fotografia almacenado correctamente.']);
        }

        return response()->json(['message' => 'No se ha seleccionado ningún archivo.']);
    }




    public function store(Request $request)
    {
        $funcionario = PSX::create([
            'nYaPSX' => $request->input('nYaPSX'),
            'ciPSX' => $request->input('ciPSX'),
            'funcFecha_nacimiento' => $request->input('funcFecha_nacimiento'),
            'funcSexo' => $request->input('funcSexo'),
            'mailPSX' => $request->input('email'),
            'telPSX' => $request->input('telPSX'),
            'funcDomicilioDistrito' => $request->input('funcDomicilioDistrito'),
            'funcProfesion_funcion' => $request->input('funcProfesion_funcion'),
            'funcEspecialidad' => $request->input('funcEspecialidad'),
            'funcSub_Especialidad' => $request->input('funcSub_Especialidad'),
            'funcRegProf' => $request->input('funcRegProf'),
            'rutaFotoFunc' => $request->input('rutaFotoFunc'),
            'updated_at' => $request->input(now()),
            'created_at' => $request->input(now()),

        ]);


    return response()->json(['success' => true, 'idPSX' => $funcionario->id]);
    }


    /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $IdFunc
   * @return \Illuminate\Http\Response
   */
    public function edit($id)
  {
    $where = ['idPSX' => $id];

    $funcionarios = PSX::where($where)->first();

    return response()->json($funcionarios);
  }

    public function update(Request $request, PSX $funcionario)
    {
        $funcionario->update($request->all());

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario actualizado correctamente.');
    }


    /**
   * Remove the specified resource from storage.
   *
   * @param  int  $IdFunc
   * @return \Illuminate\Http\Response
   */
    public function destroy($id)
    {
        $funcionarios = PSX::where('idPSX', $id)->delete();

    }


}
