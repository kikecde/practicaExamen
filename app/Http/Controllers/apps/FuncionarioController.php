<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\FuncionSEME;
use App\Models\PSX;
use App\Models\Funcionario;
use App\Models\FuncionarioEstablecimiento;
use App\Models\FuncionarioVinculo;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\DepartamentoMedico;
use App\Models\DepartamentoNoMed;
use App\Models\Sector;
use App\Models\ProfFuncion;
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

      $funcionario = Funcionario::with(['vinculos.establecimientos'])->find($idFunc);

      if ($funcionario) {
          // Información básica del funcionario
          $response = [
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
          ];

          // Información sobre los vínculos
          $vinculosData = [];
          foreach ($funcionario->vinculos as $vinculo) {
              $establecimientos = [];
              foreach ($vinculo->establecimientos as $establecimiento) {
                  $establecimientos[] = [
                      'nombre' => $establecimiento->NombreEstablecimiento,
                      // Aquí puedo agregar otros campos del establecimiento si es necesario
                  ];
              }

              $vinculosData[] = [
                  'institucion' => $vinculo->institucion->nombreInstitucion ?? null,
                  'ordenVinculo' => $vinculo->ordenVinculo->nombreOrden ?? null,
                  'tipoVinculo' => $vinculo->tipoVinculo->nombreTipo ?? null,
                  'horas' => $vinculo->HorasVinc,
                  'establecimientos' => $establecimientos,
              ];
          }

          $response['vinculos'] = $vinculosData;

          return response()->json($response);
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

    public function checkFuncionarioByCI($funcCI)
    {
        // Busca al funcionario por su número de identidad
        $funcionario = Funcionario::where('funcCI', $funcCI)->first();

        // Si el funcionario existe, devuelve sus detalles
        if ($funcionario) {
            return response()->json([
                'exists' => true,
                'funcionario' => $funcionario,
            ]);
        } else {
            return response()->json([
                'exists' => false,
                'message' => 'No se encontró un funcionario con ese número de identidad.',
            ]);
        }
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
          //6 => 'funcProfesion_funcion',
          //7 => 'funcSexo'


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
        $estab = [];

        $totalData = Funcionario::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');

        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (empty($request->input('search.value'))) {
          $funcionarios = Funcionario::with(['areas', 'cargos', 'establecimientos', 'vinculos.establecimiento'])
              ->offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
      } else {

          $search = $request->input('search.value');
          $estab = $request->input('estab.value');

          $funcProfesion_funcion = ProfFuncion::where('NombProfes', 'LIKE', "%{$search}%")->pluck('idProfFunc')->toArray();

          $funcEstabIds = Establecimiento::where('NombreEstablecimiento', 'LIKE', "%{$search}%")->pluck('idEst')->toArray();
          $funcIdsFromEstab = FuncionarioEstablecimiento::whereIn('estID', $funcEstabIds)->pluck('funcID')->toArray();



          $funcionarios = Funcionario::with(['areas', 'cargos', 'establecimientos'])
            ->where('idFunc', 'LIKE', "%{$search}%")
            ->orWhere('funcNombres', 'LIKE', "%{$search}%")
            ->orWhere('funcCI', 'LIKE', "%{$search}%")
            ->orWhereIn('funcProfesion_funcion', $funcProfesion_funcion)
            ->orWhereIn('idFunc', $funcIdsFromEstab)
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

          $totalFiltered = Funcionario::where('idfunc', 'LIKE', "%{$search}%")
            ->orWhere('funcNombres', 'LIKE', "%{$search}%")
            ->orWhere('funcCI', 'LIKE', "%{$search}%")
            ->orWhereIn('funcProfesion_funcion', $funcProfesion_funcion)
            ->orWhereIn('idFunc', $funcIdsFromEstab)
            ->count();
        }

        $data = [];

        if (!empty($funcionarios)) {
          // crear un "dummy id" en vez del id de la DB
          $ids = $start;

            //preparacion de algunos datos

          $funcProfesion_funcion = $funcionarios->pluck('funcProfesion_funcion')->toArray();
          $profFunciones = ProfFuncion::whereIn('idProfFunc', $funcProfesion_funcion)
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


            $nestedData['funcEstablecimiento'] = $funcionario->establecimientos->map(function($establecimientoRel) {
              return $establecimientoRel->establecimiento->NombreEstablecimiento ?? null;
          })->implode(', ');

            //$nestedData['funcEstablecimiento'] = $funcionario->establecimientos->implode('NombreEstablecimiento', ', ');

            $nestedData['idUser'] = $funcionario->idUser;

            //$horas => $funcionario->vinculos->HorasVinc,
            $nestedData['vinculosCount'] = $funcionario->vinculos->count();
           // $nestedData['vinculoStatus'] = $funcionario->vinculos->vinculoStatus;

            $nestedData['vinculos'] = $funcionario->vinculos->map(function ($vinculo) {
                return [
                    'horas' => $vinculo->HorasVinc,
                    'establecimiento' => $vinculo->establecimiento->NombreEstablecimiento ?? null
                ];
            });
            $nestedData['totalHoras'] = $funcionario->vinculos->sum('HorasVinc');

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


      public function listaFuncionarios()
    {
        $funcionarios = Funcionario::all();
        return view('funcionario.index', ['funcionarios' => $funcionarios]);
    }



    public function showFuncionario($id)
    {
        $funcionario = Funcionario::with(['vinculos', 'profesion', 'establecimientos'])
            ->find($id);
        return view('funcionario.show', ['funcionario' => $funcionario]);
    }

    public function show($idFunc)
{
    $funcionario = Funcionario::with(['vinculos', 'profesion', 'establecimientos'])
    ->find($idFunc);


    if (!$funcionario) {
        return response()->json(['error' => 'Funcionario no encontrado'], 404);
    }

    if ($funcionario->profesion) {
        $funcionario->funcProfesion_funcion = $funcionario->profesion->NombProfes;
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




    public function assignVinculoToFuncionario(Request $request, $id)
    {
        // Lógica para asignar un vínculo a un Funcionario
    }

    public function removeVinculoFromFuncionario($funcionarioId, $vinculoId)
    {
        // Lógica para eliminar un vínculo de un Funcionario
    }

    public function assignFuncionarioToEstablecimiento(Request $request, $id)
    {
        // Lógica para asignar un Funcionario a un Establecimiento
    }

    public function removeFuncionarioFromEstablecimiento($funcionarioId, $establecimientoId)
    {
        // Lógica para desasignar un Funcionario de un Establecimiento
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
