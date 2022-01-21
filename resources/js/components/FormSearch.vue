<template>
    <div class="row">
        <div class="col-3">
            <select class="form-select" name="tipo_de_busqueda" id="type-search" v-model="type">
                <option value="1">Número de expediente</option>
                <option value="2">Fecha</option>
                <option value="3">Juez</option>
                <option value="6">Tipo de audiencia</option>
            </select>
        </div>

        <div class="col-5" id="search-expediente">
            <div v-if="type === '1'">
                <input type="text" class="form-control" name="buscar" placeholder="Número de expediente">
            </div>

            <div v-else-if="type === '2'">
                <input type="date" class="form-control" name="buscar">
            </div>

            <div v-else-if="type === '3'">
                <input type="text" class="form-control" name="buscar" placeholder="Ingrese el nombre del Juez">
            </div>

             <div v-else-if="type === '6'">
                <select class="form-select" name="buscar">
                    <option selected>Seleccione tipo de audiencia</option>
                    <option v-for="audiencia in audiencias" :key="audiencia.id" :value="audiencia.id"> {{ audiencia.nombre }} </option>
                </select>
            </div>

            <div v-else>
                Seleccione un tipo de busqueda
            </div>
        </div>

        <div class="col" v-if="type !== 'Seleccione el tipo de busqueda'">
            <button type="submit" class="btn btn-primary" id="btn-search-filter">Buscar</button>
        </div> 
    </div>
</template>

<script>
export default {
    data() {
        return {
            audiencias: [],
            type: 'Seleccione el tipo de busqueda',
        }
    },

    created() {
        this.getTipoAudiencia()
    },

    methods: {
        getTipoAudiencia() {
            const url = baseURL + '/buscar/expediente/tipo-audiencias/all';

            axios.get(url)
            .then(response => response.data)
            .then(data => {
               console.log(data);
               this.audiencias = data;
            })
            .catch(function (error) {
                console.log(error);
            })
        }
    }
}
</script>