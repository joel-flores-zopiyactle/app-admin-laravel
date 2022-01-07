<template>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-12">
            <!-- Alert status recording -->

            <div class="w-100 overflow-hidden">
                <img :src="url" class="img-fluid rounded border" alt="logo">
            </div>
    
            <!-- Btns recording -->
            <div>
                <div class="d-flex justify-content-center mt-2 border p-2 bg-light">
                    <!-- play -->
                    <div v-if="showBtnPlay">
                         <button @click="startRecord" class="btn btn-success me-2 d-flex justify-content-center align-items-center">
                              <span class="iconify h4 m-0" data-icon="akar-icons:play"></span>
                         </button>
                    </div>
                    <!-- pause -->
                    <div class="d-flex justify-content-center"  v-if="!showBtnPlay">
                         <button v-if="showPause" @click="pauseRecord" class="btn btn-light d-flex justify-content-center align-items-center me-2">
                              <span class="iconify h4 m-0" data-icon="clarity:pause-solid"></span>
                         </button>
                         <!-- Renauded -->
                         <button v-if="!showPause" @click="renaurarRecord" class="btn btn-light d-flex justify-content-center align-items-center me-2">
                              <span class="iconify h4 m-0" data-icon="clarity:play-solid"></span>
                         </button>

                         <!-- Stop -->
                         <button @click="stopRecord"  class="btn btn-outline-danger d-flex justify-content-center align-items-center">
                              <span class="iconify h4 m-0" data-icon="healthicons:stop-outline"></span>
                         </button>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
            
        </div>
    </div>
</template>

<script>

export default {

     data() {
          return {
               showBtnPlay: true,
               statusRecord: '', // estados de grabación
               bgStatusConnectOBS: 'btn-outline-danger',
               statusTextConnectOBS : 'Conectar OBS',
               showPause: true, // permite oculatr y mostrar los botnes de pausa y renaurar
               url: '', 
               expedienteID: 0,
               showFormFile: false,
               file: null, // archvivo
               duration: '', // duracion del video grabado
               ubication: '', // ubicacion del vidoe guardado desde OBS
              
               showSpinner: false,
          }
     },

    created() {
          
    },

     methods: {

          getIdExpedinete() {
               // ID
               const expedienteID =  document.getElementById('expediente_id');
               this.expedienteID = expedienteID.value;
          },

          cargarImagen() {
               this.url = baseURL + '/img/sinjo_logo.png';
          },

          

          startRecord() {
               
          },

          pauseRecord() {
              
          },

          renaurarRecord() {
              
          },

          stopRecord() {

          },

          changeBGImage(data = {}) {
               // console.log(data);
               if(data.img) {
                    this.url = data.img;
               } else {
                    this.url = baseURL + '/img/sinjo_logo.png'; // Img default
               } 
          },

         

            getFileVideo() {
                let file = document.getElementById('uploadFileVideo');
                this.file = file
                // console.log(this.file);
            },

            async uploadFileVideo() {
                this.validateFormVideo.required = false
                this.showSpinner = true

                if(this.file === null) {
                        this.validateFormVideo.required = true
                        this.validateFormVideo.mensaje = 'Debe de seleccionar un archivo'
                        this.showSpinner = false
                        return
                }

                let formData = new FormData()

                formData.append('video', this.file.files[0])
                formData.append('expediente_id', this.expedienteID)
                formData.append('duracion', this.duration);

                const token =  document.getElementsByName('_token')

                const config = { 
                        headers: { 'Content-Type': 'multipart/form-data' },
                        'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                }

                // Envio los datos al servidor
                const res = await axios.post(`${baseURL}/evento/video`, formData, config)
                .then( res => res)
                .catch(function (error) {
                        console.log(error)
                });

                if(res.data.status === 201) {

                        this.validateFormVideo.required = true
                        this.validateFormVideo.mensaje  = res.data.mensaje  
                        this.validateFormVideo.alert    = 'alert-success'
                        this.showSpinner = false
                        document.getElementById('uploadFileVideo').value = "";

                }

                if(res.data.status === 404) {
                        this.validateFormVideo.required = true
                        this.validateFormVideo.mensaje  = res.data.mensaje  
                        this.validateFormVideo.alert    = 'alert-warning'
                        this.showSpinner = false
                        document.getElementById('uploadFileVideo').value = "";
                }

                if(res.data.status === 500) {
                        this.validateFormVideo.required = true
                        this.validateFormVideo.mensaje  = res.data.mensaje  
                        this.validateFormVideo.alert    = 'alert-danger'
                        this.showSpinner = false
                        document.getElementById('uploadFileVideo').value = "";
                }
            },

     },

    mounted() {

    },

}
</script>