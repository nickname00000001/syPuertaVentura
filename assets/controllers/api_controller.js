import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['output','select','payButton'];

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
            const headers = ['Nombre', 'Precio', 'Disponible','Cantidad','Accion'];

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
                input.id = `quantity-${plate.id}`;
                input.min = 0;
                input.value = 0;
                quantityCell.appendChild(input);
                row.appendChild(quantityCell);

                const accionCell = document.createElement('td');

                const addButton = document.createElement('button');
                addButton.textContent = 'Añadir';
                addButton.classList.add('btn', 'btn-success', 'me-2');
                addButton.addEventListener('click',(event) => this.updateOrder(event, plate.id));
                accionCell.appendChild(addButton);

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Eliminar';
                deleteButton.classList.add('btn', 'btn-danger');
                accionCell.appendChild(deleteButton);

                row.appendChild(accionCell);

                tbody.appendChild(row);
            });

            table.appendChild(tbody);

            this.outputTarget.appendChild(table);

        } catch (error) {
            console.error('Error fetching data:', error);
            this.outputTarget.innerHTML = `<p style="color: red;">Error al obtener datos</p>`;
        }
    }




    async pay(event) {

        
        event.preventDefault(); // Evitar recargar la página

        const url = '/api/pay'; // URL de la API

        console.log(this.outputTarget);
        const data = {
            type: selectedValue,
            // Agrega más datos según sea necesario
        };

        try {
            const response = await fetch(url, {
                method: 'POST', // Método POST
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data), // Cuerpo de la solicitud
            });

             if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

        } catch (error) {
            console.error('Error fetching data:', error);
            this.outputTarget.innerHTML = `<p style="color: red;">Error al obtener datos</p>`;
        }
    }


    async updateOrder(event,plateId) {

        event.preventDefault(); // Evitar recargar la página

        
        const input = document.getElementById(`quantity-${plateId}`);
        if (!input) {
            console.error(`Element with id quantity-${plateId} not found`);
            return;
        }
        const quantity = input.value;

        const url = '/api/ordersession'; // URL de la API

        const data = {
            id: plateId,
            cantidad: quantity
        };

        try {
            const response = await fetch(url, {
                method: 'POST', // Método POST
                headers: {
                    'Content-Type': 'application/json', // Tipo de contenido
                },
                body: JSON.stringify(data), // Cuerpo de la solicitud
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const responseData = await response.json();

        } catch (error) {
            console.error('Error fetching data:', error);
            this.outputTarget.innerHTML = `<p style="color: red;">Error al obtener datos</p>`;
        }
    }








}