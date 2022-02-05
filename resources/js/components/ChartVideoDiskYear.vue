<script>
    import { Bar } from 'vue-chartjs'
    export default {
        extends: Bar,
        data() {
            return {
                data: null
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
                    this.renderChart({
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        datasets:data
                        },
                        {
                            responsive: true,
                            maintainAspectRatio: false
                        })            
                }) 
                .catch(function (error) {
                    console.log(error);
                })
            },
        },

        mounted () {
          /*   this.getDataAudienciasCelebradas();
            // Overwriting base render method with actual data.
            const datos = this.data;
            console.log(datos); */

           
        },

    }
</script>