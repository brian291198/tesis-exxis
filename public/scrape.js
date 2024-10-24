import puppeteer from 'puppeteer';

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    
    // Navegar a la página deseada
    await page.goto('https://www.sunat.gob.pe/');

    // Esperar a que los elementos estén disponibles
    await page.waitForSelector('#date'); // Selector para la fecha
    await page.waitForSelector('#sell-rate'); // Selector para el valor de venta

    // Obtener los valores de los elementos
    const tipoCambioData = await page.evaluate(() => {
        const date = document.querySelector('#date') ? document.querySelector('#date').innerText.trim() : null;
        const sellRate = document.querySelector('#sell-rate') ? document.querySelector('#sell-rate').innerText.trim() : null;
        return { date, sellRate };
    });

    // Imprimir el JSON en la salida estándar (stdout)
   /*  process.stdout.write(JSON.stringify(tipoCambioData)); // Mostrar la información como JSON */

    // Imprimir el JSON en la consola
    console.log(JSON.stringify(tipoCambioData)); // Mostrar la información como JSON

    await browser.close();
})();

