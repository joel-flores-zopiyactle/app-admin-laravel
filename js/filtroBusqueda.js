const typeSearch = document.getElementById('type-search')
const searchExpediente = document.getElementById('search-expediente');
const btnSearchFilter = document.getElementById('btn-search-filter');


btnSearchFilter.style.visibility =  'hidden';

typeSearch.addEventListener('change', () => {
    
    const typeForm = typeSearch.value;

    console.log(typeForm);

    btnSearchFilter.style.visibility =  'visible';

    switch (typeForm) {
        case '1': // Numero de expediente
            searchExpediente.innerHTML = '<input type="number" class="form-control" name="buscar" id="buscar" placeholder="Número de expediente">';
            //  console.log('add form text');
            break;
        
        case '2': // Fecha de expediente
            searchExpediente.innerHTML = '<input type="date" class="form-control" name="buscar" id="buscar">';
            //  console.log('add form date');
            break;  
        
        case '3': // Juez de expediente
            searchExpediente.innerHTML = '<input type="text" class="form-control" name="buscar" id="buscar" placeholder="Ingrese el nombre del Juez">';
            //  console.log('add form text juez');
            break;
            
        case '4': // Auxiliar sala de expediente
            searchExpediente.innerHTML = '<input type="text" class="form-control" name="buscar" id="buscar" placeholder="Ingrese el nombre del auxiliar">';
            //  console.log('add form text auxiliar');
            break;
            
        case '5': // Partes de expediente
            searchExpediente.innerHTML = '<input type="text" class="form-control" name="buscar" id="buscar" placeholder="Ingrese el nombre del partes">';
            //  console.log('add form text partes');
            break;

        case '6': // Tipo de audiencia de expediente
           
            searchExpediente.innerHTML = `
            <select class="form-select" name="buscar" id="select-buscar-expediente">
                <option selected>Seleccione tipo de audiencia</option>
            </select>
            `
            getTipoAudiencias();
            break;
    
        default:
            searchExpediente.innerHTML = '';
            btnSearchFilter.style.visibility =  'hidden';
            break;
    }
})


function getTipoAudiencias() {
    // TODO: Cambiar url local a uno mas generico
    const url = baseURL + '/buscar/expediente/tipo-audiencias/all';
    fetch(url)
    .then(response => response.json())
    .then(data => {
        const selectBuscarExpediente = document.getElementById('select-buscar-expediente');
        data.forEach(tipo => {
            selectBuscarExpediente.innerHTML += ` <option value="${tipo.id}">${tipo.nombre}</option>`;
        });
    });
}