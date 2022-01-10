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
            this.getDataAudienciasCelebradas();
        },


        methods: {
           
            getDataAudienciasCelebradas() {
                axios.get(`${baseURL}/analisis/estadistico/audiencias-celebredas`)
                .then( response => response.data )
                .then( data => {
                    this.renderChart({
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        datasets: [
                                {
                                    label: 'Audiencias celebradas',
                                    backgroundColor: '#f87979',
                                    data: data
                                }
                            ]
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