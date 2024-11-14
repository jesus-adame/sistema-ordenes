<script lang="ts" setup>
import { computed, reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { CartProduct } from '@/types';

const props = defineProps<{
    customers: any,
    products: CartProduct[]
}>();

const emit = defineEmits(['sended'])
const showAddModal = ref(false);
const selectedProduct = ref<CartProduct|string>('');
const selectedQuantity = ref<number>(1);

function openAddModal() {
    showAddModal.value = true;
}

function removeProd(index: number) {
    form.products.splice(index, 1);
}

function closeAddModal() {
    showAddModal.value = false;
    selectedProduct.value = '';
    selectedQuantity.value = 1;
}

const form = reactive<{
    order_date: string;
    customer_id: string;
    products: CartProduct[];
}>({
    order_date: '',
    customer_id: '',
    products: [],
})

function submit() {
    emit('sended')
    router.post(route('orders.store'), form)
}

function pushProduct() {
    if (typeof selectedProduct.value != 'string') {
        let product = selectedProduct.value
        product.quantity = selectedQuantity.value

        form.products.push(product);
    }

    closeAddModal()
}

const total = computed(() => {
    return (form.products.reduce((acc: number, p: CartProduct) => acc + ((p.price * (1 + p.tax / 100)) * p.quantity), 0)).toFixed(2);
});
</script>
<template>
    <form @submit.prevent="submit" class="bg-gray-800 rounded-lg shadow-lg space-y-4">
        <div class="flex justify-between">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-300">Fecha</label>
                <input v-model="form.order_date" type="date" id="date" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John Doe">
            </div>

            <div>
                <label for="customer" class="block text-sm font-medium text-gray-300">Cliente</label>
                <select
                    v-model="form.customer_id"
                    class="w-full bg-gray-800 text-gray-400 border border-gray-700 rounded-lg py-2 mt-1 pl-3 pr-10 focus:outline-none focus:ring focus:border-blue-500"
                >
                    <option value="" disabled>Select an option</option>
                    <option
                        v-for="option in props.customers"
                        :key="option.id"
                        :value="option.id"
                    >
                        {{ option.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
            <table class="min-w-full text-sm text-left text-gray-400">
                <thead class="bg-gray-700 text-xs uppercase font-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">Producto</th>
                        <th scope="col" class="px-6 py-3">IVA</th>
                        <th scope="col" class="px-6 py-3">Precio</th>
                        <th scope="col" class="px-6 py-3">Cantidad</th>
                        <th scope="col" class="px-6 py-3">Subtotal</th>
                        <th>
                            <button type="button" @click="openAddModal" class="bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded">Cargar</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in form.products" :key="index" class="border-b border-gray-700">
                        <td class="px-6 py-4">{{ item.name }}</td>
                        <td class="px-6 py-4">{{ item.tax / 100 }}</td>
                        <td class="px-6 py-4">{{ item.price }}</td>
                        <td class="px-6 py-4">{{ item.quantity }}</td>
                        <td class="px-6 py-4">{{ ((item.price * (1 + item.tax / 100)) * item.quantity).toFixed(2) }}</td>
                        <td><button type="button" @click="removeProd(index)" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded">Cancelar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <span>Total: </span>
            <span>{{ total }}</span>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Registrar orden</button>
    </form>

    <div v-if="showAddModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-gray-800 text-white rounded-lg shadow-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold mb-4">Cargar producto</h2>
            <select
                v-model="selectedProduct"
                class="w-full bg-gray-800 text-gray-400 border border-gray-700 rounded-lg py-2 mt-1 pl-3 pr-10 focus:outline-none focus:ring focus:border-blue-500"
            >
                <option value="" disabled>Select an option</option>
                <option
                    v-for="option in props.products"
                    :key="option.id"
                    :value="option"
                >
                    {{ option.name }}
                </option>
            </select>

            <div>
                <label for="number" class="block text-sm font-medium text-gray-300">Cantidad</label>
                <input v-model="selectedQuantity" type="number" id="number" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John Doe">
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button @click="pushProduct" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded">Cargar</button>
                <button @click="closeAddModal" class="bg-gray-600 hover:bg-gray-700 text-white py-1 px-3 rounded">Cerrar</button>
            </div>
        </div>
    </div>
</template>