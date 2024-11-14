<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OrdersTable from '@/Partials/Tables/OrdersTable.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Órdenes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Órdenes</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <OrdersTable></OrdersTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>