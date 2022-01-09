<template>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-12">
            <!-- Alert status recording -->

            <div class="w-100 overflow-hidden d-flex align-content-center justify-content-center">
                <!-- <img :src="url" class="img-fluid rounded border" alt="logo"> -->
               <video autoplay id="video" class="img-fluid bg-dark" ></video>
            </div>
    
            <!-- Btns recording -->
            <div>
                <div class="d-flex justify-content-center mt-2 border p-2 bg-light">
                   <button @click="startRecord" type="button" class="btn btn-primary me-2">Play</button>                   
                   <button @click="pauseRecord" type="button" class="btn btn-primary me-2">Pause</button>                   
                   <button @click="resumenRecord" type="button" class="btn btn-primary me-2">Resumen</button>                   
                   <button @click="stopRecord" type="button" class="btn btn-primary">Stop</button>                   
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
               expedienteID: 0,
               chunks: [],
               mediaRecorder: [],
               video: [],
               duration: 0

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

          startRecord() {

               this.video = document.querySelector('#video');

               navigator.mediaDevices.getUserMedia({
                    audio: false,
                    video: true
               }).then( data => {

                    this.video.srcObject = data;

                    let options = { mimeType: 'video/webm;codecs=h264'}

                    if(!MediaRecorder.isTypeSupported('video/webm;codecs=h264')) {
                         options = { mimeType: 'video/webm;codecs=vp8' }
                    }

                    this.mediaRecorder = new MediaRecorder(data, options);

                    this.mediaRecorder.start();

                    this.mediaRecorder.ondataavailable = (e) => {
                         this.chunks.push(e.data)
                    }
               })
               .catch(err => console.log(err));
          },

          pauseRecord() {
               console.log(this.mediaRecorder)
               this.video.pause();
               this.mediaRecorder.onpause =  () => { 
                    alert('La grabación se a pausado')
               }

               this.mediaRecorder.pause()
          },

          resumenRecord() {
               console.log(this.mediaRecorder)
               this.mediaRecorder.onresume =  () => { 
                    alert('La grabación se ha renaudado')
               }

               this.mediaRecorder.resume()
               this.video.play();
          },

          stopRecord() {
               this.mediaRecorder.onstop =  () => { 
                    alert('La grabación a finalizado');
                    let blob = new Blob(this.chunks, {type: 'video/webm'})
                    this.chunks = []
                    // this.download(blob)
                    this.uploadFileVideo(blob)
               }
                    
               this.mediaRecorder.stop()
          },

          download(blob) { 
               let link = document.createElement('a')
               link.href = window.URL.createObjectURL(blob)
               link.setAttribute('download', 'video_recorder.webm');
               link.style.display = 'none'

               document.body.appendChild(link)

               link.click()

               link.remove()
          },

          async uploadFileVideo(video) {
              console.log(video);
               let formData = new FormData()

               formData.append('video', video)
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
               
               console.log(res);
          },

     }
}

// export default {

//      data() {
//           return {
//               chunks: [],
//               mediaRecorder: [],
//               expedienteID: 0

//           }    
//      },

//     created() {
//           this. cargarImagen()
//     },

//      methods: {

//           getIdExpedinete() {
//                // ID
//                const expedienteID =  document.getElementById('expediente_id');
//                this.expedienteID = expedienteID.value;
//           },

//           cargarImagen() {
//                this.url = baseURL + '/img/sinjo_logo.png';
//           },

//           connect() {

//           },         

//           startRecord() {
//                let video = document.querySelector('#video');
//                navigator.mediaDevices.getUserMedia({
//                     audio: false,
//                     video: true
//                }).then( data =>{
//                     this.record(data, video)
//                })
//                .catch(err => console.log(err));          
//           },

//           record(stream, video) {
                    
//                video.srcObject = stream;

//                let options = { mimeType: 'video/webm;codecs=h264'}

//                if(!MediaRecorder.isTypeSupported('video/webm;codecs=h264')) {
//                     options = { mimeType: 'video/webm;codecs=vp8' }
//                }

//                this.mediaRecorder = new MediaRecorder(stream, options);

//                this.mediaRecorder.start();

//                this.mediaRecorder.ondataavailable = function(e) {
//                     this.chunks.push(e.data)
//                }

//                console.log(this.chunks);
//           },

//           pauseRecord() {
              
//           },

//           renaurarRecord() {
              
//           },

//           stopRecord() {
//                this.mediaRecorder.onstop =  function () { 
//                     alert('La grabación a finalizado');
//                     let blob = new Blob(this.chunks, {type: 'video/webm'})
//                     this.chunks = []
//                     download(blob)
//                }
                    
//                this.mediaRecorder.stop()
//           },

//           download(blob) { 
//                let link = document.createElement('a')
//                link.href = window.URL.createObjectURL(blob)
//                link.setAttribute('download', 'video_recorder.webm');
//                link.style.display = 'none'

//                document.body.appendChild(link)

//                link.click()

//                link.remove()
//           },

//           changeBGImage(data = {}) {
//                // console.log(data);
//                if(data.img) {
//                     this.url = data.img;
//                } else {
//                     this.url = baseURL + '/img/sinjo_logo.png'; // Img default
//                } 
//           },        

//           getFileVideo() {
//                let file = document.getElementById('uploadFileVideo');
//                this.file = file
//                // console.log(this.file);
//           },

//           async uploadFileVideo() {
//                this.validateFormVideo.required = false
//                this.showSpinner = true

//                if(this.file === null) {
//                     this.validateFormVideo.required = true
//                     this.validateFormVideo.mensaje = 'Debe de seleccionar un archivo'
//                     this.showSpinner = false
//                     return
//                }

//                let formData = new FormData()

//                formData.append('video', this.file.files[0])
//                formData.append('expediente_id', this.expedienteID)
//                formData.append('duracion', this.duration);

//                const token =  document.getElementsByName('_token')

//                const config = { 
//                     headers: { 'Content-Type': 'multipart/form-data' },
//                     'X-CSRF-TOKEN': token[0].value,// <--- aquí el token
//                }

//                // Envio los datos al servidor
//                const res = await axios.post(`${baseURL}/evento/video`, formData, config)
//                .then( res => res)
//                .catch(function (error) {
//                     console.log(error)
//                });

//                if(res.data.status === 201) {

//                     this.validateFormVideo.required = true
//                     this.validateFormVideo.mensaje  = res.data.mensaje  
//                     this.validateFormVideo.alert    = 'alert-success'
//                     this.showSpinner = false
//                     document.getElementById('uploadFileVideo').value = "";

//                }

//                if(res.data.status === 404) {
//                     this.validateFormVideo.required = true
//                     this.validateFormVideo.mensaje  = res.data.mensaje  
//                     this.validateFormVideo.alert    = 'alert-warning'
//                     this.showSpinner = false
//                     document.getElementById('uploadFileVideo').value = "";
//                }

//                if(res.data.status === 500) {
//                     this.validateFormVideo.required = true
//                     this.validateFormVideo.mensaje  = res.data.mensaje  
//                     this.validateFormVideo.alert    = 'alert-danger'
//                     this.showSpinner = false
//                     document.getElementById('uploadFileVideo').value = "";
//                }
//           },

//      },

//     mounted() {

//     },

// }
</script>