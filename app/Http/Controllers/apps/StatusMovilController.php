<?php

namespace App\Http\Controllers\apps;

    use Facebook\WebDriver\Remote\RemoteWebDriver;
    use Facebook\WebDriver\WebDriverBy;
    use Facebook\WebDriver\WebDriverExpectedCondition;
    use Facebook\WebDriver\Chrome\ChromeOptions;
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Log;
    use App\Models\Movil;
    use App\Models\StatusMovil;

    class StatusMovilController extends Controller
    {
        public function storeScrapedData()
        {
          try {
            // Iniciar el WebDriver
            $host = 'http://192.168.100.8:4444/wd/hub';  // Cambiar si tu servidor Selenium está en una ubicación diferente
            //$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

            // Configurar Chrome en modo headless
            $options = new ChromeOptions();
            $options->addArguments(['--headless']);
            $capabilities = DesiredCapabilities::chrome();
            $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

            $driver = RemoteWebDriver::create($host, $capabilities);

            // Navegar a la página
            $driver->get('http://www.petropar.gov.py:8082/webflota/');

            // Rellenar y enviar el formulario de login
            $driver->findElement(WebDriverBy::name('UsrLogin'))->sendKeys('MSP01');
            $driver->findElement(WebDriverBy::name('UsrPassword'))->sendKeys('1234');
            $driver->findElement(WebDriverBy::cssSelector('div.button.send.user'))->click();

            // Esperar a que la página se cargue
            $driver->wait()->until(
                WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('#square-5'))
            );

            // Navegar al informe
            $driver->findElement(WebDriverBy::cssSelector('a[onclick^="page3(\'controller/report/cardBalance.cnt\'"]'))->click();

            // Esperar a que la página del informe se cargue
            $driver->wait(90, 1000)->until(
                WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('div.report'))
            );

            // Realizar el web scraping en los resultados
            $rows = $driver->findElements(WebDriverBy::cssSelector('tbody tr'));
            $headers = ['Tarjeta', 'Estado', 'Conductor', 'Producto Habilitado', 'Chapa', 'Modelo', 'Vehiculo', 'Consumo Acumulado', 'Saldo', 'Limite/Mes', 'Consumo/Mes', 'Saldo/Mes'];

            $structuredData = [];

            foreach ($rows as $row) {
                $cells = $row->findElements(WebDriverBy::tagName('td'));
                $dataRow = [];
                foreach ($cells as $index => $cell) {
                    $header = $headers[$index] ?? null;  // Asegúrate de que el índice exista
                    if ($header !== null) {
                        $dataRow[$header] = trim($cell->getText());
                    }
                }
                $structuredData[] = $dataRow;
            }

              // Filtrar los datos
              $tarjetas = Movil::pluck('tarjetaPETROPAR')->toArray();
              $filteredData = array_filter($structuredData, function ($dataRow) use ($tarjetas) {
                  return in_array($dataRow['Tarjeta'], $tarjetas);
              });

              // Guardar los datos filtrados en la base de datos
              foreach ($filteredData as $dataRow) {
                // Buscar el movilID usando la tarjeta
                $movil = Movil::where('tarjetaPETROPAR', $dataRow['Tarjeta'])->first();

                if ($movil) {
                    $statusMovil = StatusMovil::firstOrNew(['movilID' => $movil->idMovil]);
                    $statusMovil->statusSaldo = intval(str_replace('.', '', $dataRow['Saldo']));
                    $statusMovil->saldoAcumulado = intval(str_replace('.', '', $dataRow['Consumo Acumulado']));
                    $statusMovil->updateSaldo = now();
                    $statusMovil->save();
                }
            }

            // Cerrar el WebDriver
            $driver->quit();

            return response()->json(['message' => 'Datos almacenados correctamente']);

          } catch (\Exception $e) {
            Log::error('Error during scraping: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred during scraping.'], 500);
        }
        }
















      // public function storeScrapedData()
      // {
      //     // Iniciar el cliente web
      //     $client = \Symfony\Component\Panther\PantherTestCase::startWebServer();


      //     // Abrir la página de inicio de sesión
      //     $crawler = $client->request('GET', 'http://www.petropar.gov.py:8082/webflota/');

      //     // Llenar el formulario de inicio de sesión y enviarlo
      //     $crawler->filter('input[name="UsrLogin"]')->sendKeys('MSP01');
      //     $crawler->filter('input[name="UsrPassword"]')->sendKeys('1234');
      //     $crawler->filter('div.button.send.user')->click();

      //     // Esperar a que la página se cargue después del inicio de sesión
      //     $client->waitFor('#square-5');

      //     // Hacer clic en el enlace del informe
      //     $crawler->filter('a[onclick^="page3(\'controller/report/cardBalance.cnt\'"]')->click();

      //     // Esperar a que la página del informe se cargue
      //     $client->waitFor('div.report', 90000); // 90 segundos

      //     // Realizar el web scraping en los resultados
      //     $rows = $crawler->filter('tbody tr')->each(function ($tr) {
      //         return $tr->filter('td')->each(function ($td) {
      //             return trim($td->text());
      //         });
      //     });

      //     // Procesar los datos
      //     $headers = ['Tarjeta', 'Estado', 'Conductor', 'Producto Habilitado', 'Chapa', 'Modelo', 'Vehiculo', 'Consumo Acumulado', 'Saldo', 'Limite/Mes', 'Consumo/Mes', 'Saldo/Mes'];
      //     $structuredData = [];

      //     foreach ($rows as $row) {
      //         $dataRow = [];
      //         foreach ($row as $index => $cellValue) {
      //             $dataRow[$headers[$index]] = $cellValue;
      //         }
      //         $structuredData[] = $dataRow;
      //     }

      //     // Filtrar los datos
      //     $tarjetas = ['78258100000057896','78258100000059300','78258100000059302','78258100000059301','78258100000057898'];
      //     $filteredData = array_filter($structuredData, function ($dataRow) use ($tarjetas) {
      //         return in_array($dataRow['Tarjeta'], $tarjetas);
      //     });

      //     // Guardar los datos filtrados en la base de datos
      //     foreach ($filteredData as $dataRow) {
      //       // Buscar el movilID usando la tarjeta
      //       $movil = Movil::where('tarjetaPETROPAR', $dataRow['Tarjeta'])->first();

      //       if ($movil) {
      //           $statusMovil = StatusMovil::firstOrNew(['movilID' => $movil->idMovil]);
      //           $statusMovil->statusSaldo = $dataRow['Saldo'];
      //           $statusMovil->saldoAcumulado = $dataRow['Consumo Acumulado'];
      //           $statusMovil->updateSaldo = now();
      //           $statusMovil->save();
      //       }
      //   }

      //   // Cerrar el cliente
      //   $client->quit();
      //   return response()->json(['message' => 'Datos almacenados correctamente']);

      // }


    public function index()
    {
        $statusmoviles = StatusMovil::all();

        return view('statusmoviles.index', compact('statusmoviles'));
    }

    public function create()
    {
        return view('statusmoviles.create');
    }


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

  }



