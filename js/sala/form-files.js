// Forms 
const formFiles =  document.getElementById('formFiles');
// Form data file
const fileData =  document.getElementById('file');
const typeFile =  document.getElementById('tipo_archivo');
const formData = new FormData();
// Tables
const tableFiles =  document.getElementById('tableListFiles');
// Las variables  expediente_id, spinnerNote y token son tomados del archivo form-notas.js  

const spinnerFile = document.getElementById('spinner-file')

const spinnerLoading = `
<div class="spinner-border ms-2" role="status">
    <span class="visually-hidden">Loading...</span>
</div>`


// Get files all by expedienteID
function getAllArchivosAudiencia(expediente_id) { 

    tableFiles.innerHTML = '';
    
    axios.get(`${baseURL}/archivos/${expediente_id}`)
    .then( response => response.data )
    .then( files => {
        files.forEach(file => {
            tableFiles.innerHTML += `
            <tr>
                <td style="width: 90%">${file.nombre}</td>
                <td style="width: 10%">
                    <button id="${fileData.id}" onclick="deleteFile(${file.id})" class="btn-delete-note" type="button" class="btn btn-light btn-sm">
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

getAllArchivosAudiencia(parseInt(expedienteID.value));

// Change input type file 
fileData.addEventListener('change', () => {
    //console.log(fileData.files[0]);
    formData.append('file', fileData.files[0]);
})

// Form new File
formFiles.addEventListener('submit', (e) => {

    e.preventDefault();   

    spinnerFile.innerHTML = spinnerLoading;

    formData.append('tipo_archivo', typeFile.value);
    formData.append('expediente_id',  parseInt(expedienteID.value));

    const config = { 
        headers: { 'Content-Type': 'multipart/form-data' },
        'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
    };

    // Envia,os los datos al servidor
    axios.post(`${baseURL}/archivo`, formData, config)
    .then(function (response) {
        if(response.data.status == 201) {
            spinnerFile.innerHTML = '';

            getAllArchivosAudiencia(parseInt(expedienteID.value));

            fileData.value = '';
        }
    })
    .catch(function (error) {
        console.log(error);
    });    
})

// Delete File

function deleteFile(id) {
    if (confirm('¿Está seguro de eliminar el archivo?')) {
        const config = {  
            headers: { 'content-type': 'application/x-www-form-urlencoded' },
            'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
        };

        axios.delete(`${baseURL}/archivo/delete/${id}`, config)
        .then(function (response) {
           if(response.data.status === 200) {
            getAllArchivosAudiencia(parseInt(expedienteID.value));
           }
        })
        .catch(function (error) {
            console.log(error);
        });

    }
}
