// Forms 
const formFiles =  document.getElementById('formFiles');
// Form data file
const fileData =  document.getElementById('file');
const typeFile =  document.getElementById('tipo_archivo');
const formData = new FormData();
// Tables
const tableAsistencia =  document.getElementById('lista-asistencia');
// Las variables  expediente_id, spinnerNote y token son tomados del archivo form-notas.js  



fileData.addEventListener('change', () => {
    console.log(fileData.files[0]);
    formData.append('file', fileData.files[0]);
})

/* File */


formFiles.addEventListener('submit', (e) => {

    e.preventDefault();   

    formData.append('tipo_archivo', typeFile.value);
    formData.append('expediente_id', 8);

    fetch(`${baseURL}/archivo`, {
            method: 'post', // *GET, POST, PUT, DELETE, etc.
            headers: {
                'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
            },
            body: formData
        }
    )
    .then(response => {
        console.info(response);
        // if(response.status === 201) {
        //     console.log('Nota creada');
        //     getNotasExpediente(data.expediente_id)
        //     fileData.value =  "";
        // }
    })
    .catch(err => console.log(err));  
    
})



/* Notas */
/* 
function getNotasExpediente(expediente_id) {
    tableNotes.innerHTML = '';
    fetch(`${baseURL}/notas/${expediente_id}`, )
    .then(response => response.json())
    .then( notas => {
        spinnerNote.innerHTML = '';
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
 */
// Get all notes
/* getNotasExpediente(expedienteID.value);
 */
// CREATE NEW NOTE *POST
/* formNote.addEventListener('submit', (e) => {
    e.preventDefault();

   
    spinnerNote.innerHTML = spinner;

    let data = {
        //'_token': token[0].value,
        'nota': note.value,
        'visibilidad': visibility.checked,
        'expediente_id': parseInt(expedienteID.value)
    }

    fetch(`${baseURL}/nota`, {
            method: 'post', // *GET, POST, PUT, DELETE, etc.
            headers: {
                'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
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
 */

// DELETE NOTE *DELETE
// function deleteNote(id) { 

//     if (confirm('¿Está seguro de eliminar la nota?')) {
//         fetch(`${baseURL}/nota/delete/${id}`, {
//             method: 'get',
//             mode: 'cors',
//             headers: {
//                 'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
//                 'Content-Type': 'application/json',
//             }
//         })
//         .then(response => {
//             if(response.status === 200) {
//                 getNotasExpediente(expedienteID.value);
//             }
//         })
//         .catch(err => console.log(err));
//     }

    
//  }

/* input checked */

// visibility.addEventListener('change', (e) => {
//     e.preventDefault()
//     if(visibility.checked) {
//         console.log('Privado')
//         labelVisibility.innerText  = "Público";
//     } else {
//         labelVisibility.innerText  = "Privado";
//     }
   
// })



// **********************************************************************//
// **********************************************************************//



