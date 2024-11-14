<script lang="ts" setup>
import ErrorAlert from '@/Components/ErrorAlert.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OrdersTable from '@/Partials/Tables/OrdersTable.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['orders', 'customers', 'products', 'errors']);
</script>
<template>
    <Head title="Órdenes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Órdenes</h2>
        </template>

        <div class="py-2">
            <ErrorAlert :errors="props.errors"></ErrorAlert>

            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <OrdersTable :orders="props.orders" :customers="props.customers" :products="props.products"></OrdersTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>