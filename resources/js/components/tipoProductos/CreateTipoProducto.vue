<template>
  <div>
    <!-- boton para ver la lista de tipo de productos registradas -->
    <div class="flex justify-end items-center max-w-lg mx-auto mb-6">
      <router-link
        :to="{ name: 'ListTipoProductos' }"
        class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4">
        Volver a la lista
      </router-link>
    </div>

    <div class="bg-white shadow overflow-hidden p-6 max-w-lg mx-auto">
      <!-- formulario para crear un tipo de producto -->
      <form @submit.prevent="createTipoProducto">
        <div class="mb-8">
          <label for="tipo_producto_nombre" class="block text-lg">Nombre del Tipo de Producto</label>
          <input
            type="text"
            id="tipo_producto_nombre"
            v-model="form.tipo_producto_nombre"
            class="px-3 w-full border border-gray-400/50 py-2 text-xl rounded-lg"
            required>
        </div>

        <div class="mb-8">
          <label for="tipo_producto_descripcion" class="block text-lg">Descripción</label>
          <textarea
            id="tipo_producto_descripcion"
            v-model="form.tipo_producto_descripcion"
            rows="3"
            class="px-3 w-full border border-gray-400/50 text-xl rounded-lg"
            required>
          </textarea>
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
  tipo_producto_nombre: '',
  tipo_producto_descripcion: ''
});

//estado de carga
const loading = ref(false);

//funcion para crear un nuevo tipo de producto metodo post
const createTipoProducto = async () => {
  try {
    loading.value = true;
    const response = await axios.post('/api/crear-tipo-producto', form);
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
        router.push({ name: 'ListTipoProductos' });
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
