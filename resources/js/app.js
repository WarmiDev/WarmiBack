import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Componente principal
import App from './App.vue';

// Componentes de página
import Home from './components/Home.vue';
import CreateMarca from './components/marcas/CreateMarca.vue';
import ListMarca from './components/marcas/ListMarca.vue';
import CreateTipoProductos from './components/tipoProductos/CreateTipoProducto.vue';
import ListTipoProductos from './components/tipoProductos/ListTipoProducto.vue';

// Definir rutas
const rutas = [
  {
    path: '/',
    component: Home,
    name: 'Home'
  },
  {
    path: '/marcas/create',
    component: CreateMarca,
    name: 'CreateMarca'
  },
  {
    path: '/marcas',
    component: ListMarca,
    name: 'ListMarca'
  },
  {
    path: '/tipo-productos/create',
    component: CreateTipoProductos,
    name: 'CreateTipoProductos'
  },
  {
    path: '/tipo-productos',
    component: ListTipoProductos,
    name: 'ListTipoProductos'
  }
];

// Crear router
const router = createRouter({
    history: createWebHistory(),
    routes: rutas
});

// Crear aplicación Vue
const app = createApp(App);

// Usar router
app.use(router);

// Montar aplicación
app.mount('#app');
