<template>
  <div class="bg-white p-2 shadow">
    <div v-if="data.length > 0">
        <div class="w-100" v-for="input in data" :key="input.index">
            <div class="row w-100 gap-2">
                <div class="col-12">
                    <input-form class="" :roles="roles" />
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center my-4" v-else>No hay un campo para agregar un participante</h3>
    

    <div class="mt-3">
        <button v-if="data.length > 0" type="button" class="btn btn-sm btn-outline-danger" @click="removeInput(0)">X</button>
        <button type="button" class="btn btn-sm btn-primary me-2" @click="addFormUser">Agregar</button>
    </div>
  </div>
</template>

<script>
    export default {
        data() {
            return {

                data : [1],
                roles: [],
                count: 2

            }
        },

        created() {
            this.getRoles();
        },

        methods: {
            addFormUser() {
              this.data.push(this.count)
              this.count = this.count +1
            },
            
            removeInput(index) {
                //console.log(index);
                this.data.splice(index, 1);
            },

            getRoles() {
                axios.get(`${baseURL}/ajustes/roles/show`)
                .then( response => response.data )
                .then( roles => {
                    console.log(roles);
                    
                    this.roles = roles;
                }) 
                .catch(function (error) {
                    console.log(error);
                })
            }
        }
    }
</script>