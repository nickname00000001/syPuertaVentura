import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['output','select'];

    connect() {
        console.log("Stimulus API Controller connected!");
    }

    async fetchData(event) {
        event.preventDefault(); // Evitar recargar la página

        var url = '';
        const selectedValue = this.selectTarget.value;

        switch (selectedValue) {
            case '1':
                url = '/api/tplates?type=Entrante';
                break;
            case '2':
                url = '/api/tplates?type=Segundo';
                break;
            case '3':
                url = '/api/tplates?type=Postre';
                break;
            default:
                url = 'Selecciona una opción válida';
        }

        try {
            const response = await fetch(url); // Llamada a la API interna
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            this.outputTarget.innerHTML = ''; // Limpiar el contenido actual

            const table = document.createElement('table');
            table.classList.add('table','table-success','table-hover');

            const thead = document.createElement('thead');
            thead.classList.add('table-dark');
            const headerRow = document.createElement('tr');
            const headers = ['Nombre', 'Precio', 'Disponible','Cantidad'];

            headers.forEach(headerText => {
                const th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });

            thead.appendChild(headerRow);
            table.appendChild(thead);

            const tbody = document.createElement('tbody');

          

            data.forEach(plate => {
                const row = document.createElement('tr');

                const nameCell = document.createElement('td');
                nameCell.textContent = plate.name;
                row.appendChild(nameCell);

                const valueCell = document.createElement('td');
                valueCell.textContent = plate.value;
                row.appendChild(valueCell);

                const stockCell = document.createElement('td');
                stockCell.textContent = plate.stock;
                row.appendChild(stockCell);

                const quantityCell = document.createElement('td');
                const input = document.createElement('input');
                input.type = 'number';
                input.min = 0;
                input.value = 0;
                quantityCell.appendChild(input);
                row.appendChild(quantityCell);

                tbody.appendChild(row);
            });

            table.appendChild(tbody);

            this.outputTarget.appendChild(table);

        } catch (error) {
            console.error('Error fetching data:', error);
            this.outputTarget.innerHTML = `<p style="color: red;">Error al obtener datos</p>`;
        }
    }
}