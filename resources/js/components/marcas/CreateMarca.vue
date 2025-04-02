<template>
  <div>
    <!-- boton para ver la lista de marcas registradas -->
    <div class="flex justify-end items-center max-w-lg mx-auto mb-6">
      <router-link
        :to="{ name: 'ListMarca' }"
        class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4">
        Volver a la lista
      </router-link>
    </div>
    <!-- formulario para crear una marca -->
    <div class="bg-white shadow overflow-hidden p-5 max-w-lg mx-auto">
      <form @submit.prevent="createMarca">
        <div class="mb-8">
          <label for="marca_nombre" class="block text-lg">Nombre de la marca</label>
          <input
            type="text"
            id="marca_nombre"
            v-model="form.marca_nombre"
            class="px-3 w-full border border-gray-400/50 py-2 text-xl rounded-lg"
            required>
        </div>

        <div class="mb-8">
          <label for="marca_origen" class="block text-lg">Origen</label>
          <input
            type="text"
            id="marca_origen"
            v-model="form.marca_origen"
            class="px-3 w-full border border-gray-400/50 py-2 text-xl rounded-lg"
            required>
        </div>

        <div class="flex justify-center">
          <button
            type="submit"
            class="bg-green-400 hover:bg-green-500 text-white font-medium py-2 px-4 rounded cursor-pointer"
            :disabled="loading">
            {{ loading ? 'Guardando...' : 'Guardar' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { reactive, ref } from 'vue';
import {useRouter} from 'vue-router';
import Swal from 'sweetalert2';

const router = useRouter();

//estados reactivos
const form = reactive({
  marca_nombre: '',
  marca_origen: ''
});

//estado de carga
const loading = ref(false);

//funcion para crear una nueva marca metodo post
const createMarca = async () => {
  try {
    loading.value = true;
    const response = await axios.post('/api/crear-marca', form);
    //console.log(response);
    if(response.data.status) {
      //Alerta de éxito
      Swal.fire({
        title: 'Éxito',
        text: 'Se guardó exitosamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      }).then(() => {
        //redirigir luego de guardar
        router.push({ name: 'ListMarca' });
      });
    } else {
      console.log("Estructura inesperada en la respuesta de la API");
    }
  } catch (error) {
    console.error('Error al cargar las solicitudes:', error);
  } finally {
    loading.value = false;
  }
}
</script>
