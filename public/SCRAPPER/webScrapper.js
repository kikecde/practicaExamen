const puppeteer = require('puppeteer');
const ExcelJS = require('exceljs');
const moment = require('moment');

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
    // Crear un nuevo libro de Excel
    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet('Reporte');
    
    // Encabezados de las columnas 
    const headers = ['Tarjeta', 'Matricula', 'Vehiculo', 'Conductor', 'Fecha', 'Hora', 'Fecha Real', 'Hora Real', 'KM', 'Producto', 'Cantidad', 'Precio', 'Importe', 'Razon Social', 'Ciudad', 'Departamento', 'Codigo de Autorizacion'];
    worksheet.addRow(headers);
    
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
        obj.Timestamp = generateTimestamp(); // Llama a la función para generar el timestamp
        return obj;
    });

    // Filtrar los datos para incluir solo las filas con tarjetas en el array tarjetas
    const filteredData = structuredData.filter(dataRow => chapas.includes(dataRow['Matricula']));

        // Agregar los datos filtrados a la hoja de cálculo
        filteredData.forEach(dataRow => {
            const rowValues = headers.concat(['Timestamp']).map(header => dataRow[header] || '');
        worksheet.addRow(rowValues);
        });

    // Guardar el libro de Excel en un archivo
    const excelFileName = 'reporte_flota.xlsx';
    await workbook.xlsx.writeFile(excelFileName);
    console.log(`Archivo Excel "${excelFileName}" generado exitosamente.`);

    // Cerrar el navegador
    await browser.close();
})();

function generateTimestamp() {
    return moment().format('YYYY-MM-DD HH:mm:ss');
}