<template>
    <div class="container-fluid">
        <div>
            <div class="row mt-2">
                <!-- alerts -->
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
                    <form v-on:submit.prevent="uploadFile" enctype="multipart/form-data" method="POST">
                        
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Subir archivo</label>
                            <input class="form-control" type="file" name="file" id="file" @change="getImage()">
                        </div>

                        <div class="mt-3">
                            <select class="form-select form-select-sm" name="tipo_archivo" v-model="formFile.tipo_archivo">
                            <option selected>Seleccione tipo de archivo</option>
                            <option value="pdf">PDF</option>
                            <option value="imagen">Imagen</option>
                            <option value="video">Video</option>
                            <option value="audio">Audio</option>  
                            <option value="doc">Documento de Word</option>  
                            </select>
                        </div>

                        <div class="mt-3 d-flex">
                            <button type="submit" class="btn btn-primary">Subir</button>

                            <div id="spinner-note" v-if="showSpinner">
                                <div class="spinner-border ms-2" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>    
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-7">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 90%" scope="col">Archivos</th>
                                <th style="width: 10%" scope="col">
                                    <button class="btn btn-sm btn-light" @click="getFiles" title="Recargar datos">
                                    <span class="iconify" data-icon="ci:refresh-02"></span>
                                    </button>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="file in files" :key="file.id">
                                <td style="width: 90%">{{ file.nombre }}</td>
                                <td style="width: 10%">
                                    <button type="button" @click="deleteFile(file.id)" class="btn btn-light btn-sm">
                                        <span class="iconify h4 m-0" data-icon="fluent:delete-20-regular"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        data() {
            return {
                files: [],
                formFile : {
                    tipo_archivo: 'Seleccione tipo de archivo'
                },
                showSpinner: false,
                file: null,
                expediente_id: 0,
                formData: new FormData(),
                resFile : {
                    mensaje: '',
                    status: 0
                }
                
            }
        },

        created( ) {
            this.getIdExpedinete();
            this.getFiles();
        },

       methods: {
            getIdExpedinete() {
                // ID
                const expedienteID =  document.getElementById('expediente_id');
                this.expediente_id = expedienteID.value;
            },

            getImage() {
                let file = document.getElementById('file');
                this.file = file
                // console.log(this.file);
            },

            getFiles() {
                axios.get(`${baseURL}/archivos/${this.expediente_id}`)
                .then( response => response.data )
                .then( files => {
                    // console.log(files);
                    this.files = files;
                    this.showSpinner = false;
                }) 
                .catch(function (error) {
                    //console.log(error);
                })
            },

            async uploadFile() {
                
                this.showSpinner = true;

                let formData = new FormData()

                formData.append('file', this.file.files[0]);
                formData.append('tipo_archivo', this.formFile.tipo_archivo);
                formData.append('expediente_id', this.expediente_id);

                const token =  document.getElementsByName('_token');

                const config = { 
                    headers: { 'Content-Type': 'multipart/form-data' },
                    'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                };

                // Envia,os los datos al servidor
                const res = await axios.post(`${baseURL}/archivo`, formData, config)

                

                if(res.data.status === 500) {
                    this.showSpinner = false;
                    this.resFile.mensaje = res.data.mensaje
                    this.resFile.status = res.data.status

                } else if (res.data.status === 201) {
                    this.showSpinner = false;
                    this.resFile.mensaje = res.data.mensaje
                    this.resFile.status = res.data.status
                    this.getFiles()
                } else {
                    this.resFile.mensaje = res.data.mensaje
                    this.resFile.status = 0
                }
                

               
            },

            async deleteFile(id) {
                if (confirm('¿Está seguro de eliminar el archivo?')) {
                    
                    const token =  document.getElementsByName('_token');
                    const config = {  
                        headers: { 'content-type': 'application/x-www-form-urlencoded' },
                        'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                    };

                    const res = await axios.delete(`${baseURL}/archivo/delete/${id}`, config)

                    if(res.data.status === 200) {
                        this.resFile.mensaje = res.data.mensaje
                        this.resFile.status = 201
                        this.getFiles()
                    } else {
                        this.resFile.mensaje = 'No se pudo eliminar el archivo, intente de nuevo'
                        this.resFile.status = 500
                    }


                }
            }
       }
    }
</script>
