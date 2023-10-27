<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\FuncionSEME;
use App\Models\PSX;
use App\Models\Funcionario;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\DepartamentoMedico;
use App\Models\DepartamentoNoMed;
use App\Models\Sector;
use DB;



class FuncionarioController extends Controller
{
    public function getFuncionariosMedicosJson()
    {
      $funcionarios = Funcionario::where('funcProfesion_funcion', '4')->get();
      return response()->json($funcionarios);
    }

    public function getFuncionarioInfoJson($idFunc)
    {
      $funcionario = Funcionario::find($idFunc);

      if ($funcionario) {
          return response()->json([
            'funcNombres' => $funcionario->funcNombres,
            'funcCI' => $funcionario->funcCI,
            'funcFecha_nacimiento' => $funcionario->funcFecha_nacimiento,
            'funcSexo' => $funcionario->funcSexo,
            'funcEmail' => $funcionario->funcEmail,
            'funcTelefono' => $funcionario->funcTelefono,
            'funcProfesion_funcion' => $funcionario->funcProfesion_funcion,
            'funcEspecialidad' => $funcionario->funcEspecialidad,
            'funcSub_Especialidad' => $funcionario->funcSub_Especialidad,
            'funcRegProf' => $funcionario->funcRegProf,
            'profile_photo_path' => $funcionario->profile_photo_path,


          ]);
      } else {
          return response()->json(['error' => 'Funcionario no encontrado'], 404);
      }
    }


    public function getEnfermerosJson() {
      $enfermeros = Funcionario::whereIn('funcProfesion_funcion', [3, 10, 22])->get();
      return response()->json($enfermeros);
    }

    public function FuncionarioManagement()
    {
      $funcionarios = Funcionario::all();
      $funcionarioCount = $funcionarios->count();
      $verified = Funcionario::whereNotNull('idUser')->get()->count();
      $notVerified = Funcionario::whereNull('idUser')->get()->count();
      $funcionariosUnique = $funcionarios->unique(['funcCI']);
      $funcionarioDuplicates = $funcionarios->diff($funcionariosUnique)->count();
      $noMail = Funcionario::whereNull('funcEmail')->count();
      $medicos = Funcionario::where('funcProfesion_funcion', '4')->count();
      $enfermeros = Funcionario::whereIn('funcProfesion_funcion', [3, 10, 22])->count();
      $obstetras = Funcionario::whereIn('funcProfesion_funcion', [12, 18])->count();
      $odontologos = Funcionario::where('funcProfesion_funcion', '21')->count();

      $administrativos = Funcionario::whereIn('funcProfesion_funcion', [7,8,16])->count();
      $ssgg = Funcionario::whereIn('funcProfesion_funcion', [6, 9, 24])->count();
      $estadistas = Funcionario::whereIn('funcProfesion_funcion', [14, 15])->count();
      $deblanco = $medicos + $enfermeros + $obstetras + $odontologos;
      $otros = $funcionarioCount - $deblanco;
      $porcentajeDeBlanco = intval(($deblanco / $funcionarioCount) * 100);
    //calculos de porcentajes
      $verifiedPercentage = intval(($verified / $funcionarioCount) * 100);

      return view('content.apps.app-funcionario-management', [
        'totalFuncionario' => $funcionarioCount,
        'verified' => $verified,
        'verifiedPercentage' => $verifiedPercentage,
        'notVerified' => $notVerified,
        'funcionarioDuplicates' => $funcionarioDuplicates,
        'noMail' => $noMail,
        'medicos' => $medicos,
        'enfermeros' => $enfermeros,
        'obstetras' => $obstetras,
        'odontologos' => $odontologos,
        'administrativos' => $administrativos,
        'ssgg' => $ssgg,
        'estadistas' => $estadistas,
        'deblanco' => $deblanco,
        'otros' => $otros,
        'porcentajeDeBlanco' => $porcentajeDeBlanco

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
          1 => 'idFunc',
          2 => 'funcNombres',
          3 => 'funcCI',
          4 => 'funcEmail',
          5 => 'funcTelefono',
          6 => 'funcProfesion_funcion',

          // 4 => 'funcFecha_nacimiento',
          // 5 => 'funcSexo',
          // 6 => 'funcEmail',
          // 7 => 'funcTelefono',
          // 8 => 'funcProfesion_funcion',
          // 9 => 'funcEspecialidad',
          // 10 => 'funcSub_Especialidad',
          // 11 => 'funcRegProf',
          // 12 => 'profile_photo_path',
          // 13 => 'funcArea',
          // 14 => 'funcCargo',
          // 15 => 'funcEstablecimiento',

        ];

        $search = [];

        $totalData = Funcionario::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');

        $column = $request->input('column', 'idFunc');


        //$order = $request->input('column', 'idFunc');
        //$funcionarios->orderBy($columns[$column]); // $columns[0]


        //$column = $request->input('column'); // empty string

        //$funcionarios->orderBy($columns[$column]);



        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
          $funcionarios = Funcionario::with(['areas', 'cargos', 'establecimientos'])
              ->offset($start)
              ->limit($limit)
              ->orderBy($column)

             // ->orderBy($columns[$order])
              //->orderBy($order, $dir)
              ->get();
        } else {

          $search = $request->input('search.value');

          $funcProfesion_funcion = ProfesionFuncion::where('NombProfes', 'LIKE', "%{$search}%")->pluck('idProfFunc')->toArray();

          $funcionarios = Funcionario::with(['areas', 'cargos', 'establecimientos'])
            ->where('idFunc', 'LIKE', "%{$search}%")
            ->orWhere('funcNombres', 'LIKE', "%{$search}%")
            ->orWhere('funcCI', 'LIKE', "%{$search}%")
            ->orWhereIn('funcProfesion_funcion', $funcProfesion_funcion)
            ->orWhereIn('funcArea', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

          $totalFiltered = Funcionario::where('idfunc', 'LIKE', "%{$search}%")
            ->orWhere('funcNombres', 'LIKE', "%{$search}%")
            ->orWhere('funcCI', 'LIKE', "%{$search}%")
            ->orWhereIn('funcProfesion_funcion', $funcProfesion_funcion)
            ->count();
        }

        $data = [];

        if (!empty($funcionarios)) {
          // crear un "dummy id" en vez del id de la DB
          $ids = $start;

            //preparacion de algunos datos

          $funcProfesion_funcion = $funcionarios->pluck('funcProfesion_funcion')->toArray();
          $profFunciones = ProfesionFuncion::whereIn('idProfFunc', $funcProfesion_funcion)
            ->get()
            ->pluck('NombProfes', 'idProfFunc')
            ->toArray();

          foreach ($funcionarios as $funcionario) {
            $nestedData['funcNombres'] = $funcionario->funcNombres;
            $nestedData['idFunc'] = $funcionario->idFunc;
            $nestedData['fake_id'] = ++$ids;
            $nestedData['funcCI'] = $funcionario->funcCI;
            $nestedData['funcTelefono'] = $funcionario->funcTelefono;
            $nestedData['funcEmail'] = $funcionario->funcEmail;
            $nestedData['funcArea'] = $funcionario->areas->implode('NombreArea', ', ');
            $nestedData['funcCargo'] = $funcionario->cargos->implode('nombreCargo', ', ');
            $profFuncId = $funcionario->funcProfesion_funcion;
            $profFuncName = $profFunciones[$profFuncId] ?? '';
            $nestedData['funcProfesion_funcion'] = $profFuncName;
            $nestedData['funcProfesion_funcionId'] = $profFuncId;
            $nestedData['funcEstablecimientos'] = $funcionario->establecimientos->implode('nombreEstablecimiento', ', ');

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

    public function show($idFunc)
{
    $funcionario = Funcionario::with(['vinculos', 'profesiones', 'establecimientos'])
    ->find($idFunc);


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
            $funcionario = Funcionario::findOrFail($request->idFunc);
            $funcionario->profile_photo_path = $fotoName;
            $funcionario->save();

            return response()->json(['message' => 'Fotografia almacenado correctamente.']);
        }

        return response()->json(['message' => 'No se ha seleccionado ningún archivo.']);
    }




    public function store(Request $request)
    {
        $funcionario = Funcionario::create([
          'idFunc'=> $request->input('idFunc'),
          'funcNombres'=> $request->input('funcNombres'),
          'funcCI'=> $request->input('funcCI'),
          'funcFecha_nacimiento'=> $request->input('funcFecha_nacimiento'),
          'funcSexo'=> $request->input('funcSexo'),
          'funcEmail'=> $request->input('funcEmail'),
          'funcTelefono'=> $request->input('funcTelefono'),
          'funcProfesion_funcion'=> $request->input('funcProfesion_funcion'),
          'funcEspecialidad'=> $request->input('funcEspecialidad'),
          'funcSub_Especialidad'=> $request->input('funcSub_Especialidad'),
          'funcRegProf'=> $request->input('funcRegProf'),
          'profile_photo_path'=> $request->input('profile_photo_path'),
          'updated_at' => $request->input(now()),
            'created_at' => $request->input(now()),
            'idUser' => $request->input('idUser')

        ]);


    return response()->json(['success' => true, 'idFunc' => $funcionario->id]);
    }


    /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $idFunc
   * @return \Illuminate\Http\Response
   */
    public function edit($id)
  {
    $where = ['idFunc' => $id];

    $funcionarios = Funcionario::where($where)->first();

    return response()->json($funcionarios);
  }

    public function update(Request $request, Funcionario $funcionario)
    {
        $funcionario->update($request->all());

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario actualizado correctamente.');
    }


    /**
   * Remove the specified resource from storage.
   *
   * @param  int  $idFunc
   * @return \Illuminate\Http\Response
   */
    public function destroy($id)
    {
        $funcionarios = Funcionario::where('idFunc', $id)->delete();

    }


}
