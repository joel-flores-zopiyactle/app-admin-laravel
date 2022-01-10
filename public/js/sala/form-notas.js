// Forms 
const formNote = document.getElementById('formNote');

// Form data note
const note =  document.getElementById('nota');
const visibility = document.getElementById('visibilidad');
const labelVisibility = document.getElementById('visibilidad_label')

const spinnerNote = document.getElementById('spinner-note')

// ID
const expedienteID =  document.getElementById('expediente_id');
const token =  document.getElementsByName('_token');

// Tables
const tableNotes =  document.getElementById('lista-notas');

const spinner = `
<div class="spinner-border ms-2" role="status">
    <span class="visually-hidden">Loading...</span>
</div>
`
/* Notas */

function getNotasExpediente(expediente_id) {
    tableNotes.innerHTML = '';

    axios.get(`${baseURL}/notas/${expediente_id}`)
    .then( response => response.data )
    .then( notas => {
        spinnerNote.innerHTML = ''; // Remove spinner
        tableNotes.innerHTML = '';

        notas.forEach(nota => {
            tableNotes.innerHTML += `
            <tr>
                <td style="width: 90%">${nota.nota}</td>
                <td style="width: 10%">
                    <button id="${nota.id}" onclick="deleteNote(${nota.id})" class="btn-delete-note" type="button" class="btn btn-light btn-sm">
                        <span class="iconify h4 m-0" data-icon="fluent:delete-20-regular"></span>
                    </button>
                </td>
            </tr>
            `
        });
    }) 
    .catch(function (error) {
        console.log(error);
    })
}

// Get all notes
getNotasExpediente(expedienteID.value);

// CREATE NEW NOTE *POST
formNote.addEventListener('submit', (e) => {
    e.preventDefault();

    spinnerNote.innerHTML = spinner;  // Show spinner

    let data = {
        //'_token': token[0].value,
        'nota': note.value,
        'visibilidad': visibility.checked,
        'expediente_id': parseInt(expedienteID.value)
    }

    const config = { 
        headers: { 'Content-Type': 'application/json' },
        'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
    };

    // Envia,os los datos al servidor
    axios.post(`${baseURL}/nota`, data, config)
    .then(function (response) {
        if(response.data.status === 201) {
            getNotasExpediente(data.expediente_id)
            note.value =  "";
        }
    })
    .catch(function (error) {
        console.log(error);
    });    
})


// DELETE NOTE *DELETE
function deleteNote(id) { 

    if (confirm('¿Está seguro de eliminar la nota?')) {
        const config = {  
            headers: { 'content-type': 'application/x-www-form-urlencoded' },
            'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
        };

        axios.delete(`${baseURL}/nota/delete/${id}`, config)
        .then(function (response) {
            console.log(response);
            if(response.data.status === 200) {
                getNotasExpediente(expedienteID.value);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }   
 }

/* input checked */
// TODO: cambiatr texto del label

/* visibility.addEventListener('change', (e) => {
    e.preventDefault()
    if(visibility.checked) {
        console.log('Privado')
        labelVisibility.innerText  = "Público";
    } else {
        labelVisibility.innerText  = "Privado";
    }
   
}) */
