<template>
  <div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white shadow overflow-hidden p-10">
        <h2 class="text-lg font-medium mb-2">Gestión de marcas</h2>
        <p class="text-gray-500 mb-4">Administrar todas las marcas disponibles en el sistema.</p>
        <!-- enlace -->
        <router-link
          :to="{ name: 'ListMarca' }"
          class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4">
          Ver Marcas
        </router-link>
      </div>

      <div class="bg-white shadow overflow-hidden p-10">
        <h2 class="text-lg font-medium mb-2">Tipos de productos</h2>
        <p class="text-gray-500 mb-4">Administrar todas las categorías de productos disponibles en el sistema.</p>
        <!-- enlace -->
        <router-link
          :to="{ name: 'ListTipoProductos' }"
          class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4">
          Ver Tipos
        </router-link>
      </div>
    </div>
  </div>
</template>
