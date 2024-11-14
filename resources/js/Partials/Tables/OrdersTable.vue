<script lang="ts" setup>
import { computed, ref } from 'vue';
import CreateOrder from '../Forms/CreateOrder.vue';
import { Order, OrderProduct } from '@/types';

const props = defineProps(['orders', 'customers', 'products']);

const showCreateModal = ref(false);
const showDetailModal = ref(false);
const selectedOrder = ref<Order|null>(null);

function openDetailModal(order: Order) {
    console.log(order);

    selectedOrder.value = order
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
                    <td class="px-6 py-4">{{ item.order_date }}</td>
                    <td class="px-6 py-4">{{ item.customer.name + ' ' + item.customer.lastname }}</td>
                    <td class="px-6 py-4">{{ item.status }}</td>
                    <td><button @click="openDetailModal(item)" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded">Detalle</button></td>
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
    <div class="bg-gray-800 text-white rounded-lg shadow-lg w-2/3 p-6">
        <h2 class="text-xl font-semibold mb-4">Detalle de al orden</h2>
        <p>Folio: {{ selectedOrder?.folio }}</p>
        <p>Cliente: {{ selectedOrder?.customer.name }} {{ selectedOrder?.customer.lastname }}</p>
        <p>Fecha: {{ selectedOrder?.order_date }}</p>
        <p>Status: {{ selectedOrder?.status }}</p>

        <table class="min-w-full text-sm text-left text-gray-400 mt-4">
            <thead class="bg-gray-700 text-xs uppercase font-medium">
                <tr>
                    <th scope="col" class="px-6 py-3">Producto</th>
                    <th scope="col" class="px-6 py-3">IVA</th>
                    <th scope="col" class="px-6 py-3">Precio</th>
                    <th scope="col" class="px-6 py-3">Cantidad</th>
                    <th scope="col" class="px-6 py-3">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in selectedOrder?.order_products" :key="index" class="border-b border-gray-700">
                    <td class="px-6 py-4">{{ item.product.name }}</td>
                    <td class="px-6 py-4">{{ item.tax / 100 }}</td>
                    <td class="px-6 py-4">{{ item.price }}</td>
                    <td class="px-6 py-4">{{ item.quantity }}</td>
                    <td class="px-6 py-4">{{ ((item.price * (1 + item.tax / 100)) * item.quantity).toFixed(2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6 flex justify-end gap-2">
            <span>Total: </span>
            <span>{{ selectedOrder?.order_products.reduce((acc: number, p: OrderProduct) => acc + ((p.price * (1 + p.tax / 100)) * p.quantity), 0) }}</span>
        </div>

        <div class="mt-6 flex justify-end">
            <button @click="closeDetailModal" class="bg-gray-600 hover:bg-gray-700 text-white py-1 px-3 rounded">Cerrar</button>
        </div>
    </div>
</div>
</template>