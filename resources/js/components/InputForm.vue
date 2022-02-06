<template>
    <div class="d-flex justify-content-between">
        <div class="w-100">
            <input class="form-control w-100" type="text" name="nombre[]" placeholder="Nombre completo..." required>
        </div>

        <div class="w-100">
            <select class="form-select w-100" name="rol_id[]">
               <option  v-for="rol in roles" :key="rol.id" :value="rol.id" >{{ rol.rol }}</option>
            </select>
        </div>

        <div class="w-100">
            <textarea class="form-control w-100" name="descripcion[]" rows="1" placeholder="Descripción"></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['roles'],
    }
</script>