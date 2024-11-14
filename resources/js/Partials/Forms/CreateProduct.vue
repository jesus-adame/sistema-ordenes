<script lang="ts" setup>
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';

const emit = defineEmits(['sended'])

const form = reactive({
    name: '',
    tax: '',
    price: '',
})

function submit() {
    emit('sended')
    router.post(route('products.store'), form)
}
</script>
<template>
    <form @submit.prevent="submit" class="bg-gray-800 rounded-lg shadow-lg space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Nombre</label>
            <input v-model="form.name" type="text" id="name" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Refresco">
        </div>

        <div>
            <label for="tax-rate" class="block text-sm font-medium text-gray-300">Impuesto</label>
            <input v-model="form.tax" type="number" id="tax-rate" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.16">
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-300">Precio</label>
            <input v-model="form.price" type="number" id="price" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Registrar</button>
    </form>
</template>