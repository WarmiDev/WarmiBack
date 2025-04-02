<template>
  <div>
    <!-- boton para crear marca con la ruta especifica en app.js -->
    <div class="flex justify-end items-center mb-6">
      <router-link
        :to="{ name: 'CreateMarca' }"
        class="bg-green-400 hover:bg-green-600 text-white py-2 px-4">
        Agregar marca
      </router-link>
    </div>

    <div class="bg-white shadow overflow-hidden">
      <!-- mensaje de carga mientras se obtienen los datos -->
      <div v-if="loading" class="p-2 text-center">
        Cargando marcas...
      </div>

      <!-- mensaje cuando no hay marcas registradas -->
      <div v-else-if="marcas.length === 0" class="p-4 text-center">
        No hay marcas registradas
      </div>

      <table v-else class="w-full">
        <thead class="bg-gray-50">
          <tr class="uppercase">
            <th class="px-4 py-2 text-xs text-gray-500 font-medium text-left">ID</th>
            <th class="px-4 py-2 text-xs text-gray-500 font-medium text-left">Nombre</th>
            <th class="px-4 py-2 text-xs text-gray-500 font-medium text-left">Origen</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr v-for="marca in marcas" :key="marca.id">
            <td class="px-4 py-2 font-light">{{ marca.id }}</td>
            <td class="px-4 py-2 font-light">{{ marca.marca_nombre }}</td>
            <td class="px-4 py-2 font-light">{{ marca.marca_origen }}</td>
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
const marcas = ref([]);
//estado de carga
const loading = ref(true);

//funcion para obtener la lista de marca metodo get
const fetchMarcas = async () => {
  try {
    loading.value = true;
    const response = await axios.get('api/listar-marcas');
    //console.log(response);
    if (response.data.status) {
      marcas.value = response.data.marcas.map(item => ({
        id: item.id,
        marca_nombre: item.marca_nombre,
        marca_origen: item.marca_origen
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
  fetchMarcas();
});
</script>
