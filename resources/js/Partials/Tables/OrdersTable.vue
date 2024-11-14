<script lang="ts" setup>
import { ref } from 'vue';
import CreateOrder from '../Forms/CreateOrder.vue';

const props = defineProps(['orders', 'customers', 'products']);

const showCreateModal = ref(false);
const showDetailModal = ref(false);

function openDetailModal() {
    showDetailModal.value = true;
}

function closeDetailModal() {
    showDetailModal.value = false;
}

function openCreateModal() {
    showCreateModal.value = true;
}

function closeCreateModal() {
    showCreateModal.value = false;
}

function closeModals() {
    closeCreateModal()
    closeDetailModal()
}
</script>
<template>
<div class="container-fluid mx-auto">
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
        <table class="min-w-full text-sm text-left text-gray-400">
            <thead class="bg-gray-700 text-xs uppercase font-medium">
                <tr>
                    <th scope="col" class="px-6 py-3">Fecha</th>
                    <th scope="col" class="px-6 py-3">Cliente</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    <th><button @click="openCreateModal" class="bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded">Registrar</button></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in props.orders" :key="index" class="border-b border-gray-700">
                    <td class="px-6 py-4">{{ item.name }}</td>
                    <td class="px-6 py-4">{{ item.tax / 100 }}</td>
                    <td class="px-6 py-4">{{ item.price }}</td>
                    <td><button @click="openDetailModal" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded">Detalle</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div v-if="showCreateModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-gray-800 text-white rounded-lg shadow-lg w-2/3 p-6">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold mb-4">Registrar orden</h2>
            <div>
                <button @click="closeCreateModal" class="bg-gray-600 hover:bg-gray-700 text-white py-1 px-3 rounded">Cerrar</button>
            </div>
        </div>

        <CreateOrder @sended="closeModals" :customers="props.customers" :products="props.products"></CreateOrder>
    </div>
</div>

<div v-if="showDetailModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-gray-800 text-white rounded-lg shadow-lg w-1/3 p-6">
        <h2 class="text-xl font-semibold mb-4">Cancelar orden</h2>
        <p>La orden se cancelará.</p>

        <div class="mt-6 flex justify-end">
            <button @click="closeDetailModal" class="bg-gray-600 hover:bg-gray-700 text-white py-1 px-3 rounded">Cerrar</button>
        </div>
    </div>
</div>
</template>