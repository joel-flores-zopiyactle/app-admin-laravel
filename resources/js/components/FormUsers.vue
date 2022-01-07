<template>
  <div class="bg-white p-2 shadow">
     
    <div class="w-100" v-for="input in data" :key="input.index">
        <div class="row w-100 gap-2">
            <div class="col-12">
                <input-form class="" :roles="roles" />
            </div>
        </div>
    </div>

    <div class="mt-3">
        <button type="button" class="btn btn-sm btn-outline-danger" @click="removeInput(1)">X</button>
        <button type="button" class="btn btn-sm btn-light me-2" @click="addFormUser">Agregar</button>
    </div>
  </div>
</template>

<script>
    export default {
        data() {
            return {

                data : [1],
                roles: [],
            }
        },

        created() {
            this.getRoles();
        },

        methods: {
            addFormUser() {
              this.data.push(1)
            },
            
            removeInput(index) {
                console.log(index);
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