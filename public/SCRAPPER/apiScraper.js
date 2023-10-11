const puppeteer = require('puppeteer');
const moment = require('moment');
const { google } = require('googleapis');  
const credentials = require('/Users/kike/Downloads/client_secret_658012502114-dj1j554kekre5u0uiev3t53ioulefrgq.apps.googleusercontent.com.json'); // Reemplaza con la ubicación real de tus credenciales

const SCOPES = ['https://www.googleapis.com/auth/spreadsheets'];
const spreadsheetId = '17tLQ7AaMFnK4eeslvGwQrBEtJNrZtdi6pD90Qg6LwiY'; // Reemplaza con el ID de tu hoja de cálculo

async function main() {
    // Configurar cliente OAuth2
    const oAuth2Client = new google.auth.OAuth2(
        credentials.installed.client_id,
        credentials.installed.client_secret,
        credentials.installed.redirect_uris[0]
    );
    

    // Obtener el código de autorización (esto se hace manualmente durante la primera ejecución)
    const code = '4/0Adeu5BXiy4NC2Cs39R6kiqlk2jMpzSOBYAquJPWLXiadICuurz0uKmwV4Rv08IQofpr1XA'; // Reemplaza con el código obtenido

    // Intercambiar el código de autorización por un token de acceso
    const { tokens } = await oAuth2Client.getToken(code);
    oAuth2Client.setCredentials(tokens);

    // El token de acceso se almacena en `tokens.access_token`
    const token = tokens.access_token;

    // Iniciar Puppeteer y realizar scraping
    (async () => {
        const browser = await puppeteer.launch();
        const page = await browser.newPage();
    
        // Abrir la página de inicio de sesión
        await page.goto('http://www.petropar.gov.py:8082/webflota/');
    
        // Llenar el formulario de inicio de sesión y enviarlo
        await page.type('input[name="UsrLogin"]', 'MSP01');
        await page.type('input[name="UsrPassword"]', '1234');
        await page.click('div.button.send.user');
        
        // Esperar a que la página se cargue después del inicio de sesión
        await page.waitForSelector('#square-5');
       
        // Hacer clic en el enlace del informe
        await page.evaluate(() => {
            const reportLink = document.querySelector('a[onclick^="page3(\'controller/report/cardMovement.cnt\'"]');
            reportLink.click();
        });
    
        // Esperar a que la página del informe se cargue
        await page.waitForSelector('div.input-long');
    
        // Ingresar tarjetas y ejecutar consultas
        const chapas = ['IJL305','IJQ905','IJQ907','IJQ906','IJL299'];
        console.log(`Chapas a procesar: ${chapas}`);
        
        // Encabezados de las columnas 
        const headers = ['Tarjeta', 'Matricula', 'Vehiculo', 'Conductor', 'Fecha', 'Hora', 'Fecha Real', 'Hora Real', 'KM', 'Producto', 'Cantidad', 'Precio', 'Importe', 'Razon Social', 'Ciudad', 'Departamento', 'Codigo de Autorizacion'];
       
        
        // Realizar el web scraping en los resultados
        const data = await page.evaluate(() => {
            const rows = Array.from(document.querySelectorAll('tbody tr'));
            return rows.map(row => {
                const columns = Array.from(row.querySelectorAll('td'));
                return columns.map(column => column.textContent);
            });
        });
            
        // Mapear los datos a objetos estructurados
        const structuredData = data.map(row => {
            const obj = {};
            row.forEach((cellValue, index) => {
                obj[headers[index]] = cellValue.trim();
            });
            obj.Timestamp = generateTimestamp();
            return obj;
        });
    
        // Filtrar los datos para incluir solo las filas con tarjetas en el array tarjetas
        const filteredData = structuredData.filter(dataRow => chapas.includes(dataRow['Matricula']));

        // Crear una matriz de datos para cargar en Google Sheets
        const valuesForGoogleSheets = [headers, ...filteredData.map(dataRow => headers.map(header => dataRow[header] || ''))];

        // Agregar los datos a la hoja de cálculo de Google Sheets
        const sheets = google.sheets({ version: 'v4', auth: client });
        await sheets.spreadsheets.values.append({
            spreadsheetId,
            range: 'SALDOS_PETROPAR!A1:Q100', // Rango en el que deseas agregar los datos
            valueInputOption: 'RAW',
            insertDataOption: 'INSERT_ROWS',
            resource: {
                values: valuesForGoogleSheets
            }
        });
        // Cerrar el navegador
        await browser.close();
    })();
    
    function generateTimestamp() {
        return moment().format('DD-MM-YYYY HH:mm:ss');
    }

    // ...

    
}

main().catch(console.error);
