<template>
  <div class="bg-gray-100 min-h-screen">
    <!-- navegacion -->
    <nav class="bg-white shadow">
      <div class="max-w-xl mx-auto flex h-16">
        <h1 class="font-bold text-xl flex items-center">WarmiShop</h1>

        <div class="ml-6 flex gap-4">
          <!-- enlaces -->
          <router-link
            :to="{name: 'Home'}"
            :class="route.name === 'Home' ? 'border-green-500' : 'border-transparent'"
            class="px-5 pt-5 border-b-4">Inicio
          </router-link>

          <router-link
            :to="{name: 'ListMarca'}"
            :class="route.name === 'ListMarca' ? 'border-green-500' : 'border-transparent'"
            class="px-5 pt-5 border-b-4">Marcas
          </router-link>

          <router-link
            :to="{name: 'ListTipoProductos'}"
            :class="route.name === 'ListTipoProductos' ? 'border-green-500' : 'border-transparent'"
            class="px-5 pt-5 border-b-4">Tipos
          </router-link>
        </div>
      </div>
    </nav>

    <!-- contenido principal -->
    <main class="max-w-7xl mx-auto px-10 py-10">
      <router-view></router-view>
    </main>
  </div>
</template>

<script setup>
// useRoute para acceder a la ruta la barra de navegación
import { useRoute } from 'vue-router';
const route = useRoute();
</script>
