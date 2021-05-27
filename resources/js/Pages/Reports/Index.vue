<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Reportes</h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-6xl">
      <form>
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input class="pr-6 pb-8 w-full lg:w-1/3" label="Fecha Inicio" type="date" v-model="initialDate" />
          <text-input class="pr-6 pb-8 w-full lg:w-1/3" label="Fecha Final" type="date" v-model="finalDate" />
          <div class="w-full lg:w-1/4">
            <button class="mt-6 btn-indigo" @click="showTable = true;" type="button">Mostrar</button>
          </div>
        </div>
      </form>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto mt-4" v-if="showTable">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Nombre</th>
          <th class="px-6 pt-6 pb-4">Proveedor</th>
          <th class="px-6 pt-6 pb-4">Costo Unitario</th>
          <th class="px-6 pt-6 pb-4">Clasificación</th>
          <th class="px-6 pt-6 pb-4">Descripción</th>
        </tr>
        <tr v-for="product in products.data" :key="product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('products.edit', product.id)" tabindex="-1">
              {{ product.name }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('products.edit', product.id)" tabindex="-1">
              <div v-if="product.contact">
                {{ product.contact.name }}
              </div>
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('products.edit', product.id)" tabindex="-1">
              {{ product.unit_cost }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('products.edit', product.id)" tabindex="-1">
              {{ product.classification }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('products.edit', product.id)" tabindex="-1">
              {{ product.description }}
            </inertia-link>
          </td>
        </tr>
        <tr v-if="products.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No existen productos.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'

export default {
  metaInfo: { title: 'Reportes' },
  components: {
    TextInput,
  },
  props: {
    products: Object,
  },
  data() {
    return {
      showTable: false,
      initialDate: null,
      finalDate: null
    }
  },
  layout: Layout,
}
</script>
