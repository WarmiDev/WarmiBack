<template>
  <div>
    <!-- boton para crear tipo de producto con la ruta especifica en app.js -->
    <div class="flex justify-end items-center mb-6">
      <router-link
        :to="{ name: 'CreateTipoProductos' }"
        class="bg-green-400 hover:bg-green-600 text-white py-2 px-4">
        Agregar tipo de producto
      </router-link>
    </div>

    <div class="bg-white shadow overflow-hidden">
      <!-- mensaje de carga mientras se obtienen los datos -->
      <div v-if="loading" class="p-2 text-center">
        Cargando tipos de productos...
      </div>

      <!-- mensaje cuando no hay marcas registradas -->
      <div v-else-if="tipoProductos.length === 0" class="p-4 text-center">
        No hay tipos de productos registrados
      </div>

      <table v-else class="w-full">
        <thead class="bg-gray-50">
          <tr class="uppercase">
            <th class="px-4 py-2 text-xs text-gray-500 font-medium text-left">ID</th>
            <th class="px-4 py-2 text-xs text-gray-500 font-medium text-left">Nombre</th>
            <th class="px-4 py-2 text-xs text-gray-500 font-medium text-left">Descripción</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr v-for="tipo in tipoProductos" :key="tipo.id">
            <td class="px-4 py-2 font-light">{{ tipo.id }}</td>
            <td class="px-4 py-2 font-light">{{ tipo.tipo_producto_nombre }}</td>
            <td class="px-4 py-2 font-light">{{ tipo.tipo_producto_descripcion }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

//variables reactivas
const tipoProductos = ref([]);
//estado de carga
const loading = ref(false);

//funcion para obtener la lista de tipo de productos metodo get
const fetchTipoProductos = async () => {
  try {
    loading.value = true;
    const response = await axios.get('/api/listar-tipos-productos');
    //console.log(response);
    if(response.data.status) {
      // Mapeo explícito de cada marca
      tipoProductos.value = response.data.tipos_productos.map(item => ({
        id: item.id,
        tipo_producto_nombre: item.tipo_producto_nombre,
        tipo_producto_descripcion: item.tipo_producto_descripcion
      }));
    } else {
      console.log("Estructura inesperada en la respuesta de la API");
    }
  } catch (error) {
    console.error('Error al cargar las solicitudes:', error);
  } finally {
    loading.value = false;
  }
}

//obtener la lista de marcas al montar
onMounted(() => {
  fetchTipoProductos();
});
</script>
