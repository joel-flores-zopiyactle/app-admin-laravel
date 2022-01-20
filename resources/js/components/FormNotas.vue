<template>
    <div class="container-fluid">
        <div class="row">
             <div class="alert alert-success alert-dismissible fade show" role="alert"  v-if='resFile.status === 201'>
                {{ resFile.mensaje }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="alert alert-danger alert-dismissible fade show" role="alert"  v-if='resFile.status === 500'>
                {{ resFile.mensaje }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            <div v-else>
                
            </div>

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
                            <th style="width: 90%" scope="col">Nota</th>
                            <th style="width: 10%" scope="col">
                                <button class="btn btn-sm btn-light" @click="getDataNotes" title="Recargar datos">
                                    <span class="iconify" data-icon="ci:refresh-02"></span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="nota in notas" :key="nota.id">
                            <td style="width: 90%"> {{ nota.nota }} </td>
                            <td style="width: 10%">
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
                showSpinner: false,
                resFile : {
                    mensaje: '',
                    status: 0
                }
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

            async sendNota() {
                this.showSpinner = true;

                // Get token
                const token =  document.getElementsByName('_token');

                const config = { 
                    headers: { 'Content-Type': 'application/json' },
                    'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                };

                // console.log(this.formNote);

                //  Enviamos los datos al servidor
                const res = await axios.post(`${baseURL}/nota`, this.formNote, config)
              
                if(res.data.status === 201) {
                   
                    this.resFile.mensaje = res.data.mensaje
                    this.resFile.status = res.data.status

                    this.getDataNotes();

                } else if(res.data.status === 500) {
                    this.resFile.mensaje = res.data.mensaje
                    this.resFile.status = res.data.status

                }

                this.showSpinner = false
                this.formNote.nota = '';
                this.formNote.visibilidad = false
               
            },

            async deleteNote(id) {
                 // Get token
                const token =  document.getElementsByName('_token');

                if (confirm('¿Está seguro de eliminar la nota?')) {

                    const config = {  
                        headers: { 'content-type': 'application/x-www-form-urlencoded' },
                        'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                    };

                    const res = await axios.delete(`${baseURL}/nota/delete/${id}`, config)
                 
                    if(res.data.status === 200) {

                        this.resFile.mensaje = res.data.mensaje
                        this.resFile.status = 201
                        this.getDataNotes();

                    } else if(res.data.status === 500) {

                        this.resFile.mensaje = res.data.mensaje
                        this.resFile.status = res.data.status
                        
                    }
                   
                }   
            }


        }
    }
</script>
