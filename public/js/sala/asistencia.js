const listaAsistenciaTable = document.getElementById('lista-asistencia-tabla');
const expediente = document.getElementById('expediente_id_lista').value;
const participantes = [];


function getParticipantes( expediente_id )  { 

    listaAsistenciaTable.innerHTML = '';

    axios.get(`${baseURL}/participantes/${expediente_id}`)
    .then( response => response.data )
    .then( participantes => {

        participantes.forEach(participante => {
            listaAsistenciaTable.innerHTML += `
            <tr>
                <td>${participante.nombre}</td>
                <td>${participante.rol.rol}</td>
                <td>${participante.descripcion}</td>
                <td>
                    <span class="badge ${participante.asistencia.color}">${participante.asistencia.asistencia}</span>
                </td>

                <td>
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="iconify h4 m-0" data-icon="bi:card-list"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li>
                                <button type="button"  onclick="asistencia(${participante.asistencia.id})" class="btn btn-sm btn-light w-100">
                                    <span class="badge bg-success p-3"></span> Asistencia
                                </button>
                            </li>
                            
                            <li>
                                <button type="button" onclick="retardo(${participante.asistencia.id})" class="btn btn-sm btn-light w-100">
                                    <span class="badge bg-success p-3"></span> Retardo
                                </button>
                            </li>
                            
                            <li>
                                <button type="button" onclick="falta(${participante.asistencia.id})" class="btn btn-sm btn-light w-100">
                                    <span class="badge bg-success p-3"></span> Falta
                                </button>
                            </li>
                        </ul>
                    </div>
              
                </td>
                
            </tr>
            `
        })

    }) 
    .catch(function (error) {
        console.log(error);
    })
}
//console.log(expediente);
getParticipantes( parseInt(expediente) );

const config = { 
    headers: { 'Content-Type': 'application/json' },
    'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
};

function asistencia(id) {

    let data = {
        'asistencia': 'Asistencia',
        'color' : 'bg-success',
    }
   
    axios.put(`${baseURL}/asistencia/participante/${id}`, data, config)
    .then(function (response) {
       if(response.status === 200) {
        getParticipantes( parseInt(expediente) );
       }
    })
    .catch(function (error) {
        console.log(error);
    });
}

function retardo(id) { 
    let data = {
        'asistencia': 'Retardo',
        'color' : 'bg-warning',
    }
   
    axios.put(`${baseURL}/asistencia/participante/${id}`, data, config)
    .then(function (response) {
        if(response.status === 200) {
            getParticipantes( parseInt(expediente) );
        }
    })
    .catch(function (error) {
        console.log(error);
    });
 }

function falta(id) { 
    let data = {
        'asistencia': 'Falta',
        'color' : 'bg-danger',
    }
   
    axios.put(`${baseURL}/asistencia/participante/${id}`, data, config)
    .then(function (response) {
        if(response.status === 200) {
            getParticipantes( parseInt(expediente) );
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}