<template>
    <div class="container-fluid">

        <div class="row">
            <!-- Panel de la grabación -->
            <div class="col-7">
                <!-- Lista de camaras activadas Camaras -->
                <h5>Dispositivos de video conectados</h5>
                <div class="mb-2 d-flex flex-nowrap">
                    <button class="btn btn-sm btn-outline-primary me-1 mb-1" v-for="(video, i) in videoSourcesSelect" 
                    :key="video.deviceId" @click="changeSceneAndCamera(video, scenes[i])" >
                        Camara - {{ video.label }}
                    </button>
                </div>  

                <div class="d-flex">
                   <p class="me-3"> Escena actual activo: <b> {{ activeSceneCurrent }}</b> </p>
                   <p> Grabación: <b>{{tiempo}}</b> </p>
                </div>

                <!-- Video stream -->
                <video class="w-75 shadow border overflow-hidden bg-dark" autoplay muted id="video-record" height="50%"></video>

                <!-- Control de grabación -->
                <div class="mt-2 w-75 d-flex justify-content-center border p-2">
                    <button v-if="controls.showPlay" type="button" class="btn btn-primary me-2" @click="showConfirmRecordStart">
                        Grabar
                    </button>

                    <button v-if="controls.showPause" type="button" class="btn btn-outline-dark me-2" @click="showConfirmRecesoRecord">
                        Pausar
                    </button>

                    <button v-if="controls.showResumen" type="button" class="btn btn-outline-dark me-2" @click="showConfirmResumenRecord">
                        Renaurar
                    </button>

                    <button v-if="controls.showStop" type="button" class="btn btn-outline-danger" @click="showConfirmStopRecord">
                        Finalizar
                    </button>

                </div>
            </div>

            <!-- Mas configuraciones -->
            <div class="col-5">
                <!-- Form file video -->
                <div class="border p-2 bg-light" v-if="showFormFile">
                    <form v-on:submit.prevent="uploadFileVideo" method="POST" enctype="multipart/form-data">
                        <label class="alert alert-primary mb-2 w-100" for="video">Ruta del archivo a subir: {{ ubicationVideo }}</label>
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
    </div>
</template>

<script>
// OBS 
const OBSWebSocket = require('obs-websocket-js');
const Swal = require('sweetalert2')
const obs = new OBSWebSocket();
const obs2 = new OBSWebSocket(); // Hace una conexion a una maquina externa mediante una direccion IP
export default {
    data() {
        return {
            video: [], // video del stream de la WebCam
            scenes: [], // Escenas disponibles en OBS
            videoSourcesSelect: [],
            videoSourceId: '', // Id del dispositivo web
            audioSourcesSelect: [],
            activeSceneCurrent: 'HD60-S', // Muestra el Escena actual activo en OBS
            expedienteID: 0,
            numeroExpediente: 0,
            durationVideo: '', // Duracion del video grabado desde OBS
            ubicationVideo: '', // Ubicaccion del video gurdado desde OBS
            // Crnometro
            tiempoRef : Date.now(),
            cronometrar : false,
            acumulado : 0,
            tiempo: '00:00:00.000',
            file: null,// FIlename upload server
            validateFormVideo: { // validaciones de form 
                    required: false,
                    mensaje: '',
                    alert: 'alert-danger'
               },
            showSpinner: false,
            showFormFile: false, // Mostrar formulario para subir archivo
            controls: {
                showPlay: true,
                showPause: false,
                showResumen: false,
                showStop: false
            },
        }
    },
    created() {
        this.connectOBS()
        this.connectOBSExterno()
        this.getIdExpedinete()
    },
    
    methods: {
        // Obtener ID del expediente
        getIdExpedinete() {
            // ID
            const expedienteID =  document.getElementById('expediente_id');
            const numeroExpediente =  document.getElementById('numero_de_expediente'); // Numero de expediente
            this.expedienteID = expedienteID.value;
            this.numeroExpediente = numeroExpediente.value;
            //console.log(this.expedienteID);
        },
        // Obtener video de la WebCam
        async startVideoWebCam() {
            this.video =  document.getElementById('video-record')
            
            const constraints = {
                // {
                //     deviceId: audioSource ? {exact: audioSource} : undefined
                // }
                audio: true,
                video: {
                    deviceId: this.videoSourceId ? {exact: this.videoSourceId} : undefined
                }
            }
            navigator.getMedia = (  navigator.getUserMedia         ||
                                    navigator.webkitGetUserMedia   ||
                                    navigator.mozGetUserMedia      ||
                                    navigator.msGetUserMedia);
            try {
                const stream = await navigator.mediaDevices.getUserMedia(constraints)
                this.video.srcObject = stream
            } catch (error) {
                console.log(error);
            }
        },
        connectOBS() {
            obs.connect({ address: 'localhost:4444', password: ''}).then(() => {
                // console.log(`Success! We're connected & authenticated.`);
                return obs.send('GetSceneList');
            }).then(data => {
                // console.log(data.scenes);
                this.scenes = data.scenes
            })
            .catch(err => { // Promise convention dicates you have a catch on every chain.
                // console.log(err);
                if(err.code === 'CONNECTION_ERROR') {
                    Swal.fire({
                        icon: 'error',
                        title: 'OBS no esta activo?',
                        text: 'La aplicacion OBS no esta activado parta empezar a grabar. Debe de abrir el programa OBS para grabar la audiencia?',
                       // footer: '<a href="">Why do I have this issue?</a>'
                    })
                    //alert('OBS - No esta activado, pára empezar a grabar hay que activar OBS Studio!.')
                }
            });
           
        },
        connectOBSExterno() {
            // Si la direccion es cambiada hay que actualizar por la nueva direccion de la maquina externa
            obs2.connect({ address: '192.168.0.103:4444', password: ''}).then(() => { // TODO: Conexion por direccion IP
                // console.log(`Success! We're connected & authenticated.`);
                return obs.send('GetSceneList');
            }).then(data => { 
                console.log(data.scenes);
                //this.scenes = data.scenes
            })
            .catch(err => { // Promise convention dicates you have a catch on every chain.
                console.log(err);
                if(err.code === 'CONNECTION_ERROR') {
                    Swal.fire(
                        'OBS no esta activo?',
                        'La aplicacion OBS no esta activo en la maquina externo de respaldo?',
                        'question'
                    )
                    //alert('El segundo OBS externo - No esta activado.')
                }
            });
        },
        changeSceneHD60_S() {
            obs.send('SetCurrentScene', {'scene-name': 'HD60-S'}).then( data => {
                console.log(data);
            }).catch( err => console.log(err)) 
        },
        changeSceneHD60_Pro() {
            obs.send('SetCurrentScene', {'scene-name': 'HD60-PRO'}).then( data => {
                console.log(data);
            }).catch( err => console.log(err)) 
        },

        changeSceneAndCamera(video, scene) {
            // console.log(this.videoSourceId);
            if(this.scenes.length > 0) {
                switch (scene.name) {
                    case 'HD60-S': // TODO: cambiar por el bnombre de la capturadora
                        this.videoSourceId = video.deviceId
                        this.startVideoWebCam()
                        this.changeSceneHD60_S()
                        break;
                    
                    case 'HD60-PRO': // TODO: cambiar por el bnombre de la capturadora
                        this.videoSourceId = video.deviceId
                        this.startVideoWebCam()
                        this.changeSceneHD60_Pro()
                        break;
                    case 'OBS Virtual Camera':
                        this.videoSourceId = video.deviceId
                        this.startVideoWebCam()
                        // this.changeSceneHD60_S()
                        break;

                    default:
                        // this.changeSceneHD60_S()
                        break;
                }
            } else {
                alert('Activa OBS para cambiar de camara!')
                return
            }
        },

        listMediaDevices() {
            this.videoSourcesSelect = []
            this.audioSourcesSelect = []

            if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
                console.log("enumerateDevices() not supported.");
                return;
            }

            navigator.mediaDevices.enumerateDevices().then((devices) => {
              
                // Valida si el videoSourcesSelect ya tiene datos entonces ya no seguimmos
                if(this.videoSourcesSelect.length > 1) {
                    return;
                }        
                // Iterar sobre toda la lista de dispositivos (InputDeviceInfo y MediaDeviceInfo) 
                devices.forEach((device) => {
                    // Según el tipo de dispositivo multimedia
                    if(device.kind ===  "videoinput"){
                        // Agregar dispositivo a la lista de cámaras
                        if(device.label !== 'OBS Virtual Camera') {
                            this.videoSourcesSelect.push(device)
                        }
                        // Agregar dispositivo a la lista de micrófonos
                    } else if(device.kind ===  "audioinput") {
                        this.audioSourcesSelect.push(device)
                    }
                });
            }).catch(function (e) {
                console.log(e.name + ": " + e.message);
            });
        },
        
        // Confirms Methods
        showConfirmRecordStart() {
            Swal.fire({
                title: '¿Estas seguro de empezar a grabar la audiencia?',
                // consoleshowDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Grabar',
                //denyButtonText: `Don't save`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    //Swal.fire('Saved!', '', 'success')
                    this.startRecord()
                }
            })
        },

        showConfirmRecesoRecord() {
            Swal.fire({
                title: 'Seleccione el tipo de acción a realizar en la audiencia?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Pausar grabación',
                denyButtonText: `Entrar en receso`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) { // Establece en pausa la grabación
                    Swal.fire({
                        title: '¿Estas seguro de pausar la grabación?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Pausar grabación!',
                        cancelButtonText: 'Cancelar',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.pauseRecord()
                        }
                    })
                   
                } else if (result.isDenied) { // Establece enm receso la audeicia
                    Swal.fire({
                        title: '¿Estas seguro de esatablecer en receso la audiencia?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Establecer en receso al audiencia!',
                        cancelButtonText: 'Cancelar',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.recesoRecord()
                        }
                    })
                }
            })
        },

        showConfirmResumenRecord() {
            Swal.fire({
                title: 'Seleccione el tipo de acción a realizar en la audiencia?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Renaurar grabación',
                denyButtonText: `Entrar en receso`,
                }).then((result) => {
              
                if (result.isConfirmed) { // renaurar  grabación
                    Swal.fire({
                        title: '¿Estas seguro de renaurar la grabación?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Renaurar grabación!',
                        cancelButtonText: 'Cancelar',
                        }).then((result) => {
                        if (result.isConfirmed) {
                             this.resumenRecord()
                        }
                    })
                   
                } else if (result.isDenied) { // Establece enm receso la audeicia
                    Swal.fire({
                        title: '¿Estas seguro de esatablecer en receso la audiencia?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Establecer en receso al audiencia!',
                        cancelButtonText: 'Cancelar',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.recesoRecord()
                        }
                    })
                }
            })
        },

        showConfirmStopRecord() {
            Swal.fire({
                title: '¿Estas seguro de finalizar la audiencia?',
                text: "Una vez que finalice, se cerrara la audiencia!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, finalizar grabación!',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.stopRecord()
                }
            })
        },

        async startRecord() {
    
            try {
                //if(!confirm('¿Esta seguro de empezara a grabar?')) return
                // Se manda el comando para empezar a grabar
                this.tiempoRef = Date.now() 
                this.acumulado = 0,
                this.tiempo = '00:00:00.000'
                await obs.send('StartRecording')
                console.log('log');
                // Controls
                this.controls.showPlay  = false;
                this.controls.showPause = true;
                this.controls.showStop  = true;
                this.video.play()   
                this.cronometrar = true   
                
                await obs2.send('StartRecording')  

            } catch (error) {
                if(error.status === 'error') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: '¿Un OBS no esta activado?. Para grabar hay que conectarse a OBS...',
                    })
                }
            }  
            
        },

        async pauseRecord() {
            //if(!confirm('¿Estas seguro de pausar la grabación?')) return
            try {
                await obs.send('PauseRecording')
                // Controls
                this.controls.showPause = false;
                this.controls.showResumen = true;
               
                this.cronometrar = false
                this.video.pause()
                await  obs2.send('PauseRecording')
            } catch (error) {
                console.log(error);
            }            
        },
        
        async resumenRecord() {
            //if(!confirm('¿Estas seguro de seguir grabando?')) return
            try {
                obs.send('ResumeRecording')
                // Controls
                this.controls.showPause   = true;
                this.controls.showResumen = false;
                this.cronometrar = true
                this.video.play()
                obs2.send('ResumeRecording')
            } catch (error) {
                console.log(error);
            } 
        },

        async stopRecord() {
            try {
                const token =  document.getElementsByName('_token')
                const config = {  
                    headers: { 'content-type': 'application/x-www-form-urlencoded' },
                    'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                };

                const res = await axios.put(`${baseURL}/salas/expediente/finalizar/${this.expedienteID}`, config)

                if(res.data.status === 200) {
                    await obs.send('StopRecording')
                    this.video.pause();   
                    this.cronometrar = false
                     //Permite asignar el nombre del archivo
                    await obs.send('SetFilenameFormatting', { 'filename-formatting': `video-expediente-numero_${this.numeroExpediente}` })
                    this.showFormFile = true;
                    //Controls
                    this.controls.showPlay   = true;
                    this.controls.showPause   = false;
                    this.controls.showResumen = false;
                    this.controls.showStop    = false;
                    // Alerta de exito
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Grabación finalizada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // OBS 2
                    await obs2.send('StopRecording')
                    await obs2.send('SetFilenameFormatting', { 'filename-formatting': `video-expediente-numero_${this.numeroExpediente}` })

                } else if(res.data.status === 404) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error',
                        text: 'Ocurrio un error al establecer en receso la audiencia',
                    })
                
                } else if(res.data.status === 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrio un error al establecer en receso la audiencia, Intente de nuevo o pare la grabación desde OBS y recargue la página',
                    })
                }

            } catch (error) {
                console.log(error);
            }
           
        },

        async recesoRecord() { // Establece la audiencia en receso para ser renaudada posteriormente
            try {
                const token =  document.getElementsByName('_token')
                const config = {  
                    headers: { 'content-type': 'application/x-www-form-urlencoded' },
                    'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
                };

                const res = await axios.put(`${baseURL}/salas/expediente/pausar/${this.expedienteID}`, config)

                if(res.data.status === 200) {
                    await obs.send('StopRecording')
                    this.video.pause();   
                    this.cronometrar = false
                     //Permite asignar el nombre del archivo
                    await obs.send('SetFilenameFormatting', { 'filename-formatting': `video-expediente-numero_${this.numeroExpediente}` })
                    this.showFormFile = true;
                    //Controls
                    this.controls.showPlay   = true;
                    this.controls.showPause   = false;
                    this.controls.showResumen = false;
                    this.controls.showStop    = false;
                    // Alerta de exito
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Audiencia en receso',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // OBS 2
                    await obs2.send('StopRecording')
                    await obs2.send('SetFilenameFormatting', { 'filename-formatting': `video-expediente-numero_${this.numeroExpediente}` })

                } else if(res.data.status === 404) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error',
                        text: 'Ocurrio un error al establecer en receso la audiencia',
                    })
                
                } else if(res.data.status === 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrio un error al establecer en receso la audiencia, Intente de nuevo o pare la grabación desde OBS y recargue la página',
                    })
                }


            } catch (error) {
                console.log(error);
            }
           
        },

        cronometro() {
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
                return H.ceros(2) + ":" + M.ceros(2) + ":" + S.ceros(2) + "." + MS.ceros(3)
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
            formData.append('duracion', this.durationVideo);

            const token =  document.getElementsByName('_token')

            const config = { 
                headers: { 'Content-Type': 'multipart/form-data' },
                'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
            }

            // Envio los datos al servidor
            const res = await axios.post(`${baseURL}/evento/video`, formData, config)
            // console.log(res);
            
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
        this.startVideoWebCam()
        this.listMediaDevices()
        this.cronometro()
        // Obtner escena actual activo
        obs.on('SwitchScenes', data => { // Espera en cambio de escnea
            // console.log(data);
            this.activeSceneCurrent = data.sceneName
        });
        
        obs.on('RecordingStopping', data => {
               this.durationVideo   = data.recTimecode;
               this.ubicationVideo  = data.recordingFilename
        });

        navigator.mediaDevices.ondevicechange = () => { // se dispara mas de una vez al quitar o agregar un dispositivo
            this.listMediaDevices() 
        }
        
    },

    destroyed() {
        obs.disconnect();
        obs2.disconnect();
    }
}
</script>