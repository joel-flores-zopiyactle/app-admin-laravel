/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('form-add-users', require('./components/FormUsers.vue').default);
Vue.component('input-form', require('./components/InputForm.vue').default);
Vue.component('form-note', require('./components/FormNotas.vue').default);
Vue.component('form-file', require('./components/FormFile.vue').default);
Vue.component('tabla-asistencia', require('./components/Asistencia.vue').default);
Vue.component('tabla-asistencia-personal', require('./components/AsistenciaPersonal.vue').default);
Vue.component('form-search', require('./components/FormSearch.vue').default);
Vue.component('video-recording', require('./components/VideoRecording.vue').default);
Vue.component('video-recording-obs', require('./components/VideoRecordOBS.vue').default);
Vue.component('chart-bar-adiencias-celebradas', require('./components/ChartAudienceCelebratedYear.vue').default);
Vue.component('chart-videoconferencia-total', require('./components/ChartVideoconferencia.vue').default);
Vue.component('analisis-disc-local', require('./components/AnalisisDiscLocal.vue').default);
Vue.component('chart-disk-consumo-mb', require('./components/ChartVideoDiskYear.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
