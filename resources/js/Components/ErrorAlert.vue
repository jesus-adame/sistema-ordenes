<script lang="ts" setup>
import { computed, defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

// Recibimos el prop errors
const props = defineProps<{
  errors: Record<string, string>;
}>();

// Computed para verificar si hay errores
const hasErrors = computed(() => Object.keys(props.errors).length > 0);

const closeModal = () => {
    router.reload()
}
</script>

<template>
  <div class="container-fluid mx-auto p-4">
    <div @click="closeModal" v-if="hasErrors" class="fixed bottom-4 right-4 bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg max-w-xs">
      <h3 class="font-bold text-lg">Error</h3>
      <ul class="mt-2 space-y-1">
        <li v-for="(error, field) in errors" :key="field" class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1 4v.01M12 8h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
          </svg>
          <span>{{ error }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
/* Animación opcional */
@keyframes fadeInOut {
  0%, 100% { opacity: 0; transform: translateY(20px); }
  10%, 90% { opacity: 1; transform: translateY(0); }
}

.fixed {
  animation: fadeInOut 3s ease-in-out;
}
</style>
