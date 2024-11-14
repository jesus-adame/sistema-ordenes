<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomersTable from '@/Partials/Tables/CustomersTable.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <CustomersTable></CustomersTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>