<template>
    <div>
        <div class="container">
            <div class="row gap-3">
                <div class="col-3 card shadow" v-for="mes of data" :key="mes.id">
                   
                    <div class="card-body">
                         <section class="text-center">{{mes.mes}}</section>
                         <section class="text-center">{{mes.datos}}</section>
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
                data: []
            }
        },

        created() {
            this.getDataMBConsumido();
        },


        methods: {
           
            getDataMBConsumido() {
                axios.get(`${baseURL}/analisis/estadistico/vide/consumo/mb`)
                .then( response => response.data )
                .then( data => {
                   this.data = data           
                }) 
                .catch(function (error) {
                    console.log(error);
                })
            },
        }

    }
</script>