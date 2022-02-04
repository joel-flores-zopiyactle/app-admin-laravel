<template>
   <div>
        <button class="nav-link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
       data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" 
        aria-controls="v-pills-archivos" aria-selected="false">
            <span class="iconify h4 me-1" data-icon="ic:baseline-storage"></span><br>Almacenamiento
        </button>

        <!-- Button trigger modal -->
       <!--  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
        </button>
 -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Analisis de Almacenamiento del Disco Duro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <!--  {{ disks }} -->

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Unidad</th>
                                <th>Total de GB</th>
                                <th>Total de GB disponible</th>
                                <th>Total de GB usado</th>
                                <th>Total de % usado</th>
                                <th>Total de % sisponible</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="disk of disks" :key="disk.id">
                                <td> {{ disk.unidad }} </td>
                                <td> {{ disk.disk_total.total_GB }} GB </td>
                                <td> {{ disk.disponible.total_GB }} GB </td>
                                <td> {{ disk.consumido.total_GB }} GB </td>
                                <td> {{ disk.espacio_usado_porcentaje }} </td>
                                <td> {{ disk.espacio_disponible_porcentaje }} </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" @click="getInfoDisck()">Recargar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                   
                </div>
                </div>
            </div>
        </div>
   </div>
</template>

<script>

//var diskinfo = require('diskinfo')
export default {
    data() {
        return {

            disks: []
            
        }
    },

    created() {
       this.getInfoDisck()
    },

    methods: {
        getInfoDisck() {
            axios.get(`${baseURL}/info/disk`)
            .then( response => response.data )
            .then( disks => {
               this.disks = disks
            }) 
            .catch(function (error) {
                console.log(error);
            })
        }
    }
}
</script>