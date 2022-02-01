<script>
    import { Bar,Pie } from 'vue-chartjs'
    export default {
        extends: Pie,
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
                axios.get(`${baseURL}/analisis/estadistico/videoconferencias-celebredas`)
                .then( response => response.data )
                .then( data => {
                    this.renderChart({
                        labels: ['Si', 'No'],
                        datasets: [
                                {
                                    label: 'Videoconferencias celebradas',
                                    backgroundColor:[ '#7881df', '#e86f3c'],
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
                    
        },

    }
</script>