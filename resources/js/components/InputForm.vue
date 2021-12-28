<template>
    <div class="d-flex mb-2">
        <div>
            <input class="form-control w-100" type="text" name="nombre[]" placeholder="Nombre completo...">
        </div>

        <div>
            <select class="form-select w-100" name="rol_id[]">
               <option  v-for="rol in roles" :key="rol.id" :value="rol.id" >{{ rol.rol }}</option>
            </select>
        </div>

        <div>
            <textarea class="form-control w-100" name="descripcion[]" rows="1"></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['roles'],
    }
</script>