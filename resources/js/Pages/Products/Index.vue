<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductsTable from '@/Partials/Tables/ProductsTable.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Productos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Productos</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <ProductsTable></ProductsTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>