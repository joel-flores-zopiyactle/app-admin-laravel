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
    fetch(`${baseURL}/notas/${expediente_id}`, )
    .then(response => response.json())
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
    .catch(err => console.log(err));
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

    fetch(`${baseURL}/nota`, {
            method: 'post', // *GET, POST, PUT, DELETE, etc.
            headers: {
                'X-CSRF-TOKEN': token[0].value, // <--- aquí el token
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        }
    )
    .then(response => {
        if(response.status === 201) {
            console.log('Nota creada');
            getNotasExpediente(data.expediente_id)
            note.value =  "";
        }
    })
    .catch(err => console.log(err));   
})


// DELETE NOTE *DELETE
function deleteNote(id) { 

    if (confirm('¿Está seguro de eliminar la nota?')) {
        fetch(`${baseURL}/nota/delete/${id}`, {
            method: 'get', // TODO: No acepta metodo DELETE genara un error 
            mode: 'cors',
            headers: {
                'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if(response.status === 200) {
                getNotasExpediente(expedienteID.value);
            }
        })
        .catch(err => console.log(err));
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
