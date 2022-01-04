<template>
    <div>
        <div class="alert alert-success">
            {{ statusRecord }}
        </div>
       
        <div class="w-100 overflow-hidden">
            <img :src="url" class="img-fluid rounded border" alt="logo">
        </div>

        <!-- Btns recording -->
        <div>
            <div class="d-flex justify-content-center mt-2 border p-2 bg-light">
                <button @click="startRecord" class="btn btn-success me-2 d-flex justify-content-center align-items-center"><span class="iconify h4 m-0" data-icon="akar-icons:play"></span></button>
                <button @click="pauseRecord" class="btn btn-light d-flex justify-content-center align-items-center me-2" v-html="icon"></button>
                <button @click="stopRecord"  class="btn btn-danger d-flex justify-content-center align-items-center"><span class="iconify h4 m-0" data-icon="healthicons:stop-outline"></span></button>
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
            statusRecord: '',
            url: '',
            data: 'hola',
            expedienteID: 0,
            icon: '<span class="iconify h4 m-0" data-icon="clarity:pause-solid"></span>',
        }
    },

    created() {
        this.connectOBS();
        this.cargarImagen();
        this.getIdExpedinete()
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

        connectOBS() {
            obs.connect({
            address: 'localhost:4444',
            password: '$up3rSecretP@ssw0rd'
            })
            .then(() => {
                console.log(`Success! We're connected & authenticated.`);

                return obs.send('GetSceneList');
            })
            .then(data => {
                console.log(`${data.scenes.length} Available Scenes!`);
            })
            .catch(err => { // Promise convention dicates you have a catch on every chain.
                console.log(err);
            });
        },

        startRecord() {
            console.log(__dirname);

            if(!confirm('¿Esta seguro de empezara a grabar?')) return

            // asigno la ruta para guardar el video de la applicacíon
            obs.send('SetRecordingFolder', {
                'rec-folder': 'C:/xampp/htdocs/Laravel/sinjo-app/storage/app/public/VIDEO-AUDIENCIA'
            }).catch(error => {
                if(error.status === 'error') {
                    alert('¿OBS no esta activado?. Para grabar hay que abrir OBS...')
                }
            })

            // Se manda el comando para empezar a grabar
            obs.send('StartRecording').catch(error => console.log(error));

            // Tomo el screenshot de la gravacion
            obs.send('TakeSourceScreenshot', {
                'embedPictureFormat': 'png'
            }).then(data => {
                //console.log(data)
                this.statusRecord = 'Grabando...'
                this.changeBGImage(data);

            }).catch(error => console.log(error))
               
        },

        pauseRecord() {

            if(!confirm('¿Estas seguro de pausar la grabación?')) return
            //console.log('PauseRecording');
            this.icon = '<span class="iconify h4 m-0" data-icon="fluent:video-play-pause-24-filled"></span>'

            obs.send('PauseRecording').then(data => console.log(data))
            .catch(error => {
                //console.log(error)
                if(error.error === 'recording already paused') {
                    this.icon = '<span class="iconify h4 m-0" data-icon="clarity:pause-solid"></span>'
                    obs.send('ResumeRecording').catch(error => console.log(error));
                    this.statusRecord = 'Grabando...'
                }                
            });

             this.statusRecord = 'En Pausa...'
        },

        stopRecord() {

            if(!confirm('¿Estas seguro de finalizar la grabación?')) return

            obs.send('StopRecording').catch(error => console.log(error));
            //Permite asignar el nombre del archivo
            obs.send('SetFilenameFormatting', {
                'filename-formatting': `audiencia_numero_${this.expedienteID}`
            }).then( data => this.changeBGImage()).catch(error => console.log(error))
            
            console.log('Finalizado');
             this.statusRecord = ''
                       
        },

        changeBGImage(data = {}) {
            // console.log(data);
            if(data.img) {
                this.url = data.img;
            } else {
                this.url = baseURL + '/img/sinjo_logo.png'; // Img default
            } 
        }
    },

    mounted() {

        obs.on('SwitchScenes', data => {
            console.log(`New Active Scene: ${data.sceneName}`);
        });


        obs.on('RecordingStopping', data => {
            console.log(data);
        });

        obs.on('Heartbeat', data => {
            console.log(data);
        });
    },

    destroyed() {
       obs.disconnect();
    }

}
</script>