<template>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-12">
            <!-- Alert status recording -->
            <div>
                <div v-if="statusRecord === 'play'">
                    <div class="alert alert-success" role="alert">
                    Grabando video....
                    </div>
                </div>

                <div v-else-if="statusRecord === 'pause'">
                    <div class="alert alert-warning" role="alert">
                        Grabación pausada....
                    </div>
                </div>

                <div v-else-if="statusRecord === 'stop'">
                    <div class="alert alert-primary" role="alert">
                    Grabación finalizada....
                    </div>
                </div>

                <div v-else>
                
                </div>
            </div>

            <div class="marco alert alert-dark">
               <div class="tiempo" id="tiempo"><span class="iconify h4 me-2" data-icon="bx:bxs-video-recording"></span> {{  tiempo }}</div>
          </div>
        
            <div class="w-100 overflow-hidden">
               <video autoplay playsinline :poster="url" class="img-fluid" id="video" style="width: 100%;"></video>
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
             <div class="mb-3 mt-md-0 mt-sm-2 mt-2">
                   <!-- boton para conectarse a OBS -->
                    <button class="btn" :class="bgStatusConnectOBS" @click="connectOBS()">{{ statusTextConnectOBS }}</button>
                   <!--  <button class="btn btn-primary" @click="openProjectorOBS()">Mostrar projector OBS</button> -->
             </div>

           
            <!-- Form file video -->
            <div class="border p-2 bg-light" v-if="showFormFile">
                <form v-on:submit.prevent="uploadFileVideo" method="POST" enctype="multipart/form-data">
                    <label class="alert alert-primary mb-2 w-100" for="video">Ruta del archivo a subir: {{ ubication }}</label>
                    <input type="file" class="form-control" id="uploadFileVideo" @change="getFileVideo()" accept=".mp4,.mkv,.mov" required />

                    <div class="alert mt-2" :class="validateFormVideo.alert" v-if="validateFormVideo.required">
                        {{ validateFormVideo.mensaje }}
                    </div>

                    <div class="mt-3 d-flex">
                        <button type="submit" class="btn btn-sm btn-primary">Subir video</button>
                        <div v-if="showSpinner">
                            <div class="spinner-border ms-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>    
                        </div> <!--  Muestra el spinner de carga -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
const OBSWebSocket = require('obs-websocket-js');
const obs = new OBSWebSocket();

export default {

     data() {
          return {
               showBtnPlay: true,
               statusRecord: '', // estados de grabación
               bgStatusConnectOBS: 'btn-outline-danger',
               statusTextConnectOBS : 'Conectar',
               showPause: true, // permite oculatr y mostrar los botnes de pausa y renaurar
               url: '', 
               expedienteID: 0,
               showFormFile: false,
               file: null, // archvivo
               duration: '', // duracion del video grabado
               ubication: '', // ubicacion del vidoe guardado desde OBS
               validateFormVideo: { // validaciones de form 
                    required: false,
                    mensaje: '',
                    alert: 'alert-danger'
               },
               showSpinner: false,
               tiempoRef : Date.now(),
               cronometrar : false,
               acumulado : 0,
               tiempo: '00:00:00.000',
               video: []
          }
     },

    created() {
          this.connectOBS();
          this.cargarImagen();
          this.getIdExpedinete()

          // setInterval(() => {
                
          //      obs.on('Sleep')
          //      .then( res => {
          //           console.log(res);
          //      })
          //      .catch(error => console.log(error)); 
          // }, 1000);
    },

     methods: {

          async connect() {
               this.video = document.querySelector('#video');
               let stream = await navigator.mediaDevices.getUserMedia({ 
                    audio: false, 
                    video: {
                        deviceId: this.idDeDsipositivo
                    }
               })
               
                // console.log(this.video);

                this.video.srcObject = stream
          },


          getIdExpedinete() {
               // ID
               const expedienteID =  document.getElementById('expediente_id');
               this.expedienteID = expedienteID.value;
          },

          cargarImagen() {
               this.url = baseURL + '/img/sinjo_logo.png';
          },

          connectOBS() {
               obs.connect({
               address: 'localhost:4444',
               password: '$up3rSecretP@ssw0rd'
               })
               .then(() => {
                    console.log(`Success! We're connected & authenticated.`);
                    this.bgStatusConnectOBS = 'btn-success'
                    this.statusTextConnectOBS = 'Listo para grabar..'
                    return obs.send('GetSceneList');
               })
               .then(data => {
                    console.log(`${data.scenes.length} Available Scenes!`);
               })
               .catch(err => { // Promise convention dicates you have a catch on every chain.
               if(err.status === 'error') {
                    alert('La aplicación no se puedo conectar, verifica que OBS este activa...')
                    }
               });
          },

          startRecord() {
               
               if(!confirm('¿Esta seguro de empezara a grabar?')) return

               // asigno la ruta para guardar el video de la applicacíon
               // obs.send('SetRecordingFolder', {
               //     'rec-folder': 'C:/xampp/htdocs/Laravel/sinjo-app/storage/app/public/VIDEO-AUDIENCIA'
               // }).catch(error => {
               //     if(error.status === 'error') {
               //         alert('¿OBS no esta activado?. Para grabar hay que abrir OBS...')
               //     }
               // })

               // Se manda el comando para empezar a grabar
               obs.send('StartRecording').catch(error => {
                    if(error.status === 'error') {
                         alert('¿OBS no esta activado?. Para grabar hay que conectarse a OBS...')
                    }
               });

               // Tomo el screenshot de la gravacion
               obs.send('TakeSourceScreenshot', {
                    'embedPictureFormat': 'png'
               }).then(data => {
                    //console.log(data)
                    this.statusRecord = 'play'
                    // this.changeBGImage(data);
                    this.cronometrar = true
                    this.showBtnPlay = false
                    this.video.play()
                    this.acumulado = 0
                    this.tiempo =  '00:00:00.000'

               }).catch(error => console.log(error))
               
          },

          pauseRecord() {
               if(!confirm('¿Estas seguro de pausar la grabación?')) return
               obs.send('PauseRecording').catch(error => console.log(error))
               this.showPause = false
               this.statusRecord = 'pause'
               this.cronometrar = false
          },

          renaurarRecord() {
               if(!confirm('¿Estas seguro de seguir grabando?')) return
               obs.send('ResumeRecording').catch(error => console.log(error))
               this.showPause = true
               this.statusRecord = 'play'
               this.cronometrar = true
          },

          stopRecord() {

               if(!confirm('¿Estas seguro de finalizar la grabación?\nUna vez finalizada la grabación ya no podra grabar de nuevo.')) return

               obs.send('StopRecording')
               .then( res => {
                    
                    this.statusRecord = 'stop'
                    this.showFormFile = true;
                    this.cronometrar  = false  
                    this.showBtnPlay  = true
                    console.log('Finalizado');

               })
               .catch(error => {
                    if(error.error === 'recording not active') {
                         this.statusRecord = ''
                         this.showFormFile = false; 
                         this.cronometrar  = false  
                    }
               })
               //Permite asignar el nombre del archivo
               obs.send('SetFilenameFormatting', {
                    'filename-formatting': `audiencia_numero_${this.expedienteID}`
               }).then( data => this.changeBGImage()).catch(error => console.log('fin'))
               this.cronometrar  = false  
               this.video.pause();
          },

          changeBGImage(data = {}) {
               // console.log(data);
               if(data.img) {
                    this.url = data.img;
               } else {
                    this.url = baseURL + '/img/sinjo_logo.png'; // Img default
               } 
          },

          /* openProjectorOBS() {
               obs.send('OpenProjector').catch( error => {
                    //console.log(error);
                    if(error.code === 'NOT_CONNECTED') {
                         alert('¿OBS no esta activado?. Para activar el projector hay que activar OBS...')
                    }
               })
          }, */

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

          this.connect()

          obs.on('SwitchScenes', data => {
               console.log(`New Active Scene: ${data.sceneName}`);
          });


          obs.on('RecordingStopping', data => {
               console.log(data);
               this.duration   = data.recTimecode;
               this.ubication  = data.recordingFilename
          });

          setInterval(() => {
          //let tiempo = document.getElementById("tiempo")
          if (this.cronometrar) {
              this.acumulado += Date.now() - this.tiempoRef
          }
          this.tiempoRef = Date.now()
          this.tiempo = formatearMS(this.acumulado)
          }, 1000 / 60);

          function formatearMS(tiempo_ms) {
               let MS = tiempo_ms % 1000
               
               //Agregué la variable St para solucionar el problema de contar los minutos y horas.
               
               let St = Math.floor(((tiempo_ms - MS) / 1000))
               
               let S = St%60
               let M = Math.floor((St / 60) % 60)
               let H = Math.floor((St/60 / 60))
               Number.prototype.ceros = function (n) {
               return (this + "").padStart(n, 0)
               }

               return H.ceros(2) + ":" + M.ceros(2) + ":" + S.ceros(2)
               + "." + MS.ceros(3)
          }

     },

     destroyed() {
          obs.disconnect();
     }

}
</script>