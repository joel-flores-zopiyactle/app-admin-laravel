<template>
    <div class="row">
        <div class="col-7">
            <br>
            <div>
                <select name="" class="form-control   mb-5" id="" v-model="idDeDsipositivo" @change="connect">
                    <option selected>Tipo de camara</option>
                    <option v-for="camara in dispositivosVideo" :key="camara.id" :value="camara.deviceId">
                        {{ camara.label }}
                    </option>
                </select>

                 <select name="" class="form-control mb-5" id=""  v-model="idDeDsipositivoAudio" @change="connect">
                    <option selected>Tipo de audio</option>
                    <option v-for="audio in dispositivosAudio" :key="audio.id" :value="audio.deviceId">
                        {{ audio.label }}
                    </option>
                </select>
            </div>

            <div class="tiempo" id="tiempo"><span class="iconify h4 me-2" data-icon="bx:bxs-video-recording"></span> {{  tiempo }}</div>
            <div class="border rounded bg-light shadow-sm p-1">
                    <video autoplay playsinline :poster="url" class="img-fluid" id="video" style="width: 100%;"></video>
            </div>

            <div class="d-flex justify-content-center border p-2 rounded mt-4">
                <div v-if="showBtnPlay">
                    <button type="button" class="btn btn-outline-dark me-2" @click="recording" title="Play"> 
                        <span class="iconify m-0 h4" data-icon="carbon:play-filled-alt"></span>
                    </button>
                </div>
               
                <div v-if="!showBtnPlay">
                    <button type="button" class="btn btn-outline-primary me-2" @click="pauseRecord" title="Pause"> 
                       <span class="iconify m-0 h4" data-icon="el:pause"></span>
                    </button>
                    
                    <button type="button" class="btn btn-outline-dark me-2" @click="resumenRecord" title="Resumen"> 
                        <span class="iconify m-0 h4" data-icon="carbon:play-filled-alt"></span>
                    </button>
                    
                    <button type="button" class="btn btn-outline-danger" @click="stopRecord" title="Stop"> 
                        <span class="iconify m-0 h4" data-icon="clarity:stop-solid"></span> 
                    </button>
                </div>
            </div>

        </div>

        <div class="col-5">
            <div class="alert alert-primary d-flex align-items-center" v-if="showBarUpload">
                <div class="spinner-border me-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                <div>Subiendo video grabado....</div>
            </div>

             <div class="alert alert-success d-flex align-items-center" v-if="alert.showAlert">
                <div>{{ alert.mensaje }}</div>
            </div>
        </div>
    </div>
</template>

<script>

    const RecordRTC = require('recordrtc');

    export default {
        data() {
            return {
                recorder: [],
                video:  [],
                expedienteID: 0,
                duration: 0,
                url : '',
                showBarUpload: false,
                showBtnPlay: true,
                togglePause : true,
                alert : {
                    mensaje: '',
                    showAlert: false
                },
                tiempoRef : Date.now(),
                cronometrar : false,
                acumulado : 0,
                tiempo: '00:00:00.000',
                dispositivosVideo: [],
                dispositivosAudio: [],
                idDeDsipositivo: 0,
                idDeDsipositivoAudio: 0
            }
        },

        created() {
            this.cargarImagen()
            this.getIdExpedinete()        
            this.llenarSelectConDispositivosDisponibles()
        },

       

        methods: {
            cargarImagen() {
               this.url = baseURL + '/img/sinjo_logo.png';
            },

            async connect() {
                this.video = document.querySelector('#video');
                let stream = await navigator.mediaDevices.getUserMedia({ 
                    audio:false, 
                    video: {
                        deviceId: this.idDeDsipositivo
                    }
                })
               
                console.log(this.video);

                this.video.srcObject = stream

            },

            async llenarSelectConDispositivosDisponibles() {
                let dispositivos = await navigator.mediaDevices.enumerateDevices()
                
                dispositivos.forEach(dispositivo => {
                    console.log(dispositivo);
                    const tipo = dispositivo.kind;
                    if( tipo === 'videoinput') {
                        this.dispositivosVideo.push(dispositivo)
                    }

                    if(tipo === 'audioinput') {
                          this.dispositivosAudio.push(dispositivo)
                    }
                });
            },

            getIdExpedinete() {
               // ID
               const expedienteID =  document.getElementById('expediente_id');
               this.expedienteID = expedienteID.value;
            },
            async recording() {
                if(!confirm('¿Estas seguro de empezar a grabar?')) return

                this.video = document.querySelector('#video');
               let stream = await navigator.mediaDevices.getUserMedia({ audio: false, video: {
                    deviceId: this.idDeDsipositivo
                }})
                this.getDivices();

                console.log(this.video);

                this.video.srcObject = stream
                
                this.recorder = RecordRTC(stream, {
                    type: 'video',
                    mimeType: 'video/webm',
                });

                this.recorder.startRecording();
                this.cronometrar = true
                this.showBtnPlay = false;
            },

            async getDivices() {
                const devices = await navigator.mediaDevices.enumerateDevices()
                console.log(devices);
            },

            async pauseRecord() {
                if(!confirm('¿Estas seguro de pausar la grabación?')) return

                await this.recorder.pauseRecording();
                this.video.pause();
                this.cronometrar  = false  
                this.togglePause = false
            },

             async resumenRecord() {
                if(!confirm('¿Estas seguro de renaudar la grabación?')) return

                await this.recorder.resumeRecording();
                this.video.play();
                this.cronometrar  = true  
                this.togglePause = true
            },

            async stopRecord() {
                if(!confirm('¿Estas seguro de finalizar la grabación?')) return

                await this.recorder.stopRecording( (blobURL) => {
                    let blob = this.recorder.getBlob();
                  
                   
                   /*  console.log(blob); */
                   this.uploadFileVideo(blob);
                   //let video = this.recorder.save('video.webm');
                   //console.log(video);
                   //console.log(time);
                  
                });

                this.video.pause();
                this.cronometrar  = false  
                this.showBtnPlay = true
               
            },

            async uploadFileVideo(video) {
                console.log(video);
                this.showBarUpload = true
                let formData = new FormData()

                formData.append('video', video)
                formData.append('expediente_id', this.expedienteID)
                formData.append('duracion', this.tiempo);
                formData.append('nameVideo', `grabación_aduiencia_numero_${this.expedienteID}`);

               const token =  document.getElementsByName('_token')

                const config = { 
                        headers: { 'Content-Type': 'multipart/form-data' },
                        'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                }

               // Envio los datos al servidor
               const res = await axios.post(`${baseURL}/evento/video/stream`, formData, config)
               .then( res => res)
               .catch(function (error) {
                    console.log(error)
               }); 
               
               console.log(res);
               this.showBarUpload = false
               this.alert.showAlert = true;
               this.alert.mensaje = res.data.mensaje
               this.cargarImagen()
          },
        
        },

        mounted() {

            this.connect()

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

    }
</script>