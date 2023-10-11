<?php

namespace Tests\Browser;

use Symfony\Component\Panther\PantherTestCase;
use Facebook\WebDriver\Exception\StaleElementReferenceException;

class ScrapedData extends PantherTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testScrapingData()
    {
        $client = static::createPantherClient();

        try {
            // Abrir la página de inicio de sesión
            $crawler = $client->request('GET', 'http://www.petropar.gov.py:8082/webflota/');

            // Llenar el formulario de inicio de sesión y enviarlo
            $crawler->filter('input[name="UsrLogin"]')->sendKeys('MSP01');
            $crawler->filter('input[name="UsrPassword"]')->sendKeys('1234');
            $crawler->filter('div.button.send.user')->click();

            // Esperar a que la página se cargue después del inicio de sesión
            $client->waitFor('#square-5');

            // Esperar a que el enlace esté presente en el DOM
// Esperar a que el enlace esté presente en el DOM
// $client->wait(10, 1000, function () use ($crawler) {
//   return $crawler->filter('a[onclick^="page3(\'controller/report/cardBalance.cnt\'"]')->count() > 0;
// });

// Hacer clic en el enlace del informe con manejo de referencia obsoleta
$this->clickWithRetry($crawler, 'a[onclick^="page3(\'controller/report/cardBalance.cnt\'"]');

// Esperar a que la página del informe se cargue
$this->waitForElement($client, 'div.report', 90); // 90 segundos

            // Resto del código para raspar y procesar datos
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

            // Puedes mostrar los datos en la consola para depuración
            print_r($filteredData);
        } catch (\Symfony\Component\Panther\Exception\StaleElementReferenceException $e) {
            // Manejar la excepción aquí, puedes intentar refrescar la página o realizar alguna acción alternativa
            // También puedes imprimir un mensaje de depuración
            echo "Se encontró una referencia de elemento obsoleto. Manejando la excepción...\n";
            // Aquí puedes decidir si quieres continuar con el flujo o finalizar la prueba
        } finally {
            // Cierra el cliente Panther
            $client->quit();
        }

    }
    private function clickWithRetry($crawler, $selector, $maxRetries = 3)
    {
        $retries = 0;
        while ($retries < $maxRetries) {
            try {
                $crawler->filter($selector)->click();
                return; // Éxito, salir del bucle
            } catch (StaleElementReferenceException $e) {
                // Manejar la excepción de referencia obsoleta
                // Esperar un momento antes de volver a intentar
                sleep(2); // Puedes ajustar el tiempo de espera según sea necesario
                $retries++;
            }
        }

        // Si se agotan los intentos, puedes lanzar una excepción o tomar otra acción.
        throw new \RuntimeException("No se pudo hacer clic en el elemento después de varios intentos.");
    }

    private function waitForElement($client, $selector, $timeoutInSeconds = 30)
    {
        $client->wait($timeoutInSeconds * 1000, function () use ($client, $selector) {
            return $client->executeScript("return !!document.querySelector('$selector')");
        });
    }
}
