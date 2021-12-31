<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <form class="mb-4" v-on:submit.prevent="sendNota" method="POST">                    
                    <div>
                        <textarea name="nota" class="form-control" rows="2" placeholder="Ingrese su Nota..." minlength="4" v-model="formNote.nota" required></textarea>
                    </div>

                    <div class="mb-3 mt-3 form-check">
                        <input type="checkbox" class="form-check-input" name="visibilidad" id="visibilidad" v-model="formNote.visibilidad">
                        <label class="form-check-label" id="visibilidad_label" for="visibilidad">Privado</label>
                    </div>

                    <div class="mt-3 d-flex">
                        <button type="submit" class="btn btn-sm btn-primary">Agregar nota</button>
                        <div id="spinner-note" v-if="showSpinner">
                            <div class="spinner-border ms-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>    
                        </div> <!--  Muestra el spinner de carga -->
                    </div>
                </form>
            </div>
        <!--  Lista de notas -->
            <div class="col-7">
                <table class="table table-responsive table-striped">
                    <thead class="">
                        <tr>
                            <th scope="col">Nota</th>
                            <th scope="col">
                                <button class="btn btn-sm btn-outline-light" @click="getDataNotes">
                                    <span class="iconify" data-icon="ci:refresh-02"></span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="nota in notas" :key="nota.id">
                            <td> {{ nota.nota }} </td>
                            <td>
                                 <button type="button" class="btn btn-light btn-sm" @click="deleteNote(nota.id)">
                                    <span class="iconify h4 m-0" data-icon="fluent:delete-20-regular"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                formNote : {
                    nota: '',
                    expediente_id: 0,
                    visibilidad: false
                },
                notas : [],

                showSpinner: false
            }
        },

        created() {
            this.getIdExpedinete();
            this.getDataNotes();
        },

        methods: {
            getIdExpedinete() {
                // ID
                const expedienteID =  document.getElementById('expediente_id');
                this.formNote.expediente_id = expedienteID.value;
            },

            getDataNotes() {
                axios.get(`${baseURL}/notas/${this.formNote.expediente_id}`)
                .then( response => response.data )
                .then( notas => {
                    this.notas = notas
                    this.showSpinner = false;                  
                }) 
                .catch(function (error) {
                    console.log(error);
                })
            },

            sendNota() {
                this.showSpinner = true;

                // Get token
                const token =  document.getElementsByName('_token');

                const config = { 
                    headers: { 'Content-Type': 'application/json' },
                    'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                };

                // console.log(this.formNote);

                //  Enviamos los datos al servidor
                axios.post(`${baseURL}/nota`, this.formNote, config)
                .then(function (response) {
                    //console.log(response );
                  
                })
                .catch(function (error) {
                    console.log(error);
                });

                this.getDataNotes();
                this.formNote.nota = '';
                this.formNote.visibilidad = false;
            },

            deleteNote(id) {
                 // Get token
                const token =  document.getElementsByName('_token');

                if (confirm('¿Está seguro de eliminar la nota?')) {

                    const config = {  
                        headers: { 'content-type': 'application/x-www-form-urlencoded' },
                        'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                    };

                    axios.delete(`${baseURL}/nota/delete/${id}`, config)
                    .then(function (response) {
                        
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    this.getDataNotes();
                }   
            }


        }
    }
</script>
