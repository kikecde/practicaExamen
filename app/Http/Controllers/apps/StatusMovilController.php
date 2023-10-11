<?php


namespace App\Http\Controllers\apps;

use App\Models\StatusMovil;
use App\Models\Movil;
use Symfony\Component\Panther\PantherTestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusMovilController extends Controller
{
  public function storeScrapedData()
  {
      // Iniciar el cliente web
      $client = \Symfony\Component\Panther\PantherTestCase::startWebServer();


      // Abrir la página de inicio de sesión
      $crawler = $client->request('GET', 'http://www.petropar.gov.py:8082/webflota/');

      // Llenar el formulario de inicio de sesión y enviarlo
      $crawler->filter('input[name="UsrLogin"]')->sendKeys('MSP01');
      $crawler->filter('input[name="UsrPassword"]')->sendKeys('1234');
      $crawler->filter('div.button.send.user')->click();

      // Esperar a que la página se cargue después del inicio de sesión
      $client->waitFor('#square-5');

      // Hacer clic en el enlace del informe
      $crawler->filter('a[onclick^="page3(\'controller/report/cardBalance.cnt\'"]')->click();

      // Esperar a que la página del informe se cargue
      $client->waitFor('div.report', 90000); // 90 segundos

      // Realizar el web scraping en los resultados
      $rows = $crawler->filter('tbody tr')->each(function ($tr) {
          return $tr->filter('td')->each(function ($td) {
              return trim($td->text());
          });
      });

      // Procesar los datos
      $headers = ['Tarjeta', 'Estado', 'Conductor', 'Producto Habilitado', 'Chapa', 'Modelo', 'Vehiculo', 'Consumo Acumulado', 'Saldo', 'Limite/Mes', 'Consumo/Mes', 'Saldo/Mes'];
      $structuredData = [];

      foreach ($rows as $row) {
          $dataRow = [];
          foreach ($row as $index => $cellValue) {
              $dataRow[$headers[$index]] = $cellValue;
          }
          $structuredData[] = $dataRow;
      }

      // Filtrar los datos
      $tarjetas = ['78258100000057896','78258100000059300','78258100000059302','78258100000059301','78258100000057898'];
      $filteredData = array_filter($structuredData, function ($dataRow) use ($tarjetas) {
          return in_array($dataRow['Tarjeta'], $tarjetas);
      });

      // Guardar los datos filtrados en la base de datos
      foreach ($filteredData as $dataRow) {
        // Buscar el movilID usando la tarjeta
        $movil = Movil::where('tarjetaPETROPAR', $dataRow['Tarjeta'])->first();

        if ($movil) {
            $statusMovil = StatusMovil::firstOrNew(['movilID' => $movil->idMovil]);
            $statusMovil->statusSaldo = $dataRow['Saldo'];
            $statusMovil->saldoAcumulado = $dataRow['Consumo Acumulado'];
            $statusMovil->updateSaldo = now();
            $statusMovil->save();
        }
    }

    // Cerrar el cliente
    $client->quit();
    return response()->json(['message' => 'Datos almacenados correctamente']);

  }


    public function index()
    {
        $statusmoviles = StatusMovil::all();

        return view('statusmoviles.index', compact('statusmoviles'));
    }

    public function create()
    {
        return view('statusmoviles.create');
    }

    // public function store(Request $request)
    // {
    //     $establecimiento = Establecimiento::create($request->all());

    //     return redirect()->route('establecimientos.index')
    //         ->with('success', 'Establecimiento creado correctamente.');
    // }

//     public function store(Request $request)
// {
//     $request->validate([
//         'logo' => 'required|image|mimes:jpeg,png,gif|max:800',
//     ]);

//     if ($request->hasFile('logo')) {
//         $logo = $request->file('logo');
//         $logoName = time() . '.' . $logo->getClientOriginalExtension();
//         $logo->move(public_path('assets/img/estabsLogos'), $logoName);

//         // Guardar la ruta del logo en la columna "estLogoPath" de la tabla Establecimiento
//         $establecimiento = Establecimiento::findOrFail($request->idEst);
//         $establecimiento->estLogoPath = $logoName;
//         $establecimiento->save();

//         return response()->json(['message' => 'Logo almacenado correctamente.']);
//     }

//     return response()->json(['message' => 'No se ha seleccionado ningún archivo de logo.']);
// }

    public function edit(StatusMovil $statusmovil)
    {
        return view('statusmoviles.edit', compact('statusmoviles'));
    }

    public function update(Request $request, StatusMovil $statusmovil)
    {
        $statusmovil->update($request->all());

        return redirect()->route('statusmoviles.index')
            ->with('success', 'Status de Movil actualizado correctamente.');
    }

    public function show($movilID)
  {
    $statusmovil = StatusMovil::with('moviles')->findOrFail($movilID);

    $data = [
      'idStatusMovil' => $statusmovil->idStatusMovil,
      'movilID' => $moviles->movilID,

      'identidadMovil' => $moviles->identidadMovil,
      'statusOperativo' => $statusmovil->statusOperativo,
      'statusFuel' => $statusmovil->statusFuel,
      'statusOil' => $statusmovil->statusOil,
      'statusMecanico' => $statusmovil->statusMecanico,
      'statusSaldo' => $statusmovil->statusSaldo,
      'saldoAcumulado' => $statusmovil->saldoAcumulado,
      'updateSaldo' => $statusmovil->updateSaldo,
      'statusCubiertas' => $statusmovil->statusCubiertas,
      'statusMantenimiento' => $statusmovil->statusMantenimiento,
      'statusConductorOperativo' => $statusmovil->statusConductorOperativo,
      'statusActivo' => $statusmovil->statusActivo,
      'statusGPS' => $statusmovil->statusGPS,
      'statusDestinoActual' => $statusmovil->statusDestinoActual,
      'statusAutonomia' => $statusmovil->statusAutonomia,
      'statusConductorID' => $statusmovil->statusConductorID,
      'statusPMD1ID' => $statusmovil->statusPMD1ID,
      'statusPMD2ID' => $statusmovil->statusPMD2ID,
      'LAST_UPDATE' => $statusmovil->LAST_UPDATE
  ];

  return response()->json($data);

  }


    public function destroy(StatusMovil $statusmovil)
    {
        $statusmovil->delete();

        return redirect()->route('statusmoviles.index')
            ->with('success', 'Status de Movil eliminado correctamente.');
    }

    // public function guardarEstabInfo(Request $request)
    // {
    //     // Validar los datos del formulario
    //     $request->validate([
    //         'idEst' => 'required',
    //         'NombreEstablecimiento' => 'required',
    //         'estDistritoID' => 'required',
    //         'estTipo' => 'required',
    //         'estNivel' => 'required',
    //         'estAbrev' => 'required',
    //         'estTelefono' => 'required',
    //         'estCorreo' => 'required',

    //     ]);

    //     // Crear o actualizar el registro en la tabla Establecimiento
    //     $establecimiento = Establecimiento::updateOrCreate(
    //         ['idEst' => $request->idEst],
    //         [
    //             'NombreEstablecimiento' => $request->NombreEstablecimiento,
    //             'estDistritoID' => $request->estDistritoID,
    //             'estTipo' => $request->estTipo,
    //             'estNivel' => $request->estNivel,
    //             'estAbrev' => $request->estAbrev,
    //             'estTelefono' => $request->estTelefono,
    //             'estCorreo' => $request->estCorreo,
    //             'estUbicacion' => $request->estUbicacion,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]
    //     );

    //     // Opcional: Realizar alguna acción adicional si es necesario

    //     // Devolver una respuesta de éxito
    //     return response()->json(['message' => 'Los datos se han guardado correctamente.']);
    // }

}


