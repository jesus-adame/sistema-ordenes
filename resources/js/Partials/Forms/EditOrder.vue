<script lang="ts" setup>

</script>
<template>
    <form class="bg-gray-800 rounded-lg shadow-lg space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
            <input type="text" id="name" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John Doe">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input type="email" id="email" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="example@example.com">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input type="password" id="password" class="w-full px-3 py-2 mt-1 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="••••••••">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Registrar</button>
    </form>
</template>