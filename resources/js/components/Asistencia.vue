<template>
    <div>
        
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                <th scope="col"  style="width: 23%;">Nombre</th>
                <th scope="col"  style="width: 23%;">Rol</th>
                <th scope="col"  style="width: 23%;">Detalles</th>
                <th scope="col"  style="width: 23%;">Asistencia</th>
                <th scope="col"  style="width: 10%;"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="asistente in asistentes" :key="asistente.id">
                    <td> {{ asistente.nombre }} </td>
                    <td> {{ asistente.rol.rol }} </td>
                    <td> {{ asistente.descripcion }} </td>
                    <td>
                        <span :class="['badge', asistente.asistencia.color]">{{ asistente.asistencia.asistencia }}</span>
                    </td>
                    <td>
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="iconify h4 m-0" data-icon="bi:card-list"></span>
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <button type="button" @click="asistencia(asistente.asistencia.id)" class="btn btn-sm btn-light w-100">
                                        <span class="badge bg-success p-3"></span> Asistencia
                                    </button>
                                </li>
                                
                                <li>
                                    <button type="button"  @click="retardo(asistente.asistencia.id)" class="btn btn-sm btn-light w-100">
                                        <span class="badge bg-success p-3"></span> Retardo
                                    </button>
                                </li>
                                
                                <li>
                                    <button type="button"  @click="falta(asistente.asistencia.id)" class="btn btn-sm btn-light w-100">
                                        <span class="badge bg-success p-3"></span> Falta
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
export default {
    data() {
        return {
            expediente_id: 0,
            asistentes: [],
        }
    },

    created() {
        this.getIdExpedinete(); 
        this.getAsistentes();          
    },

    methods: {

        getIdExpedinete() {
            // ID
            const expedienteID =  document.getElementById('expediente_id_lista');
            this.expediente_id = expedienteID.value;            
        },

        getAsistentes() {
            axios.get(`${baseURL}/participantes/${this.expediente_id}`)
            .then( response => response.data )
            .then( participantes => {
                // console.log(participantes);
                this.asistentes = participantes;
            }) 
            .catch(function (error) {
                console.log(error);
            })
        },

        asistencia(id) {
           
            // Get token
            const token =  document.getElementsByName('_token');

            const config = { 
                headers: { 'Content-Type': 'application/json' },
                'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
            };

            let data = {
                'asistencia': 'Asistencia',
                'color' : 'bg-success',
            }
        
            axios.put(`${baseURL}/asistencia/participante/${id}`, data, config)
            .then(function (response) {
            })
            .catch(function (error) {
                console.log(error);
            });

            this.getAsistentes();
        },

        retardo(id) {
           
            // Get token
            const token =  document.getElementsByName('_token');

            const config = { 
                headers: { 'Content-Type': 'application/json' },
                'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
            };

            let data = {
                'asistencia': 'Retardo',
                'color' : 'bg-warning',
            }
        
            axios.put(`${baseURL}/asistencia/participante/${id}`, data, config)
            .then(function (response) {
            })
            .catch(function (error) {
                console.log(error);
            });

            this.getAsistentes();
        },

        falta(id) {
           
            // Get token
            const token =  document.getElementsByName('_token');

            const config = { 
                headers: { 'Content-Type': 'application/json' },
                'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
            };

            let data = {
                'asistencia': 'Falta',
                'color' : 'bg-danger',
            }
        
            axios.put(`${baseURL}/asistencia/participante/${id}`, data, config)
            .then(function (response) {
            })
            .catch(function (error) {
                console.log(error);
            });

            this.getAsistentes();
        }
    }
}
</script>