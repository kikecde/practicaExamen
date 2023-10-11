<?php

require 'vendor/autoload.php';

use Symfony\Component\Panther\PantherTestCase;

class WebScrapperSaldos extends PantherTestCase
{
    public function testScraping()
    {
        // Iniciar el cliente web
        $client = static::createPantherClient();

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
}
