<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('products')">Productos</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Crear
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nombre" />
          <text-input v-model="form.quantity" :error="form.errors.quantity" class="pr-6 pb-8 w-full lg:w-1/2" label="Cantidad" type="number" @input="updateTotal()" />
          <text-input v-model="form.unit_cost" :error="form.errors.unit_cost" class="pr-6 pb-8 w-full lg:w-1/2" label="Costo Unitario" type="number" @input="updateTotal()" />
          <text-input v-model="form.total_cost" :error="form.errors.total_cost" class="pr-6 pb-8 w-full lg:w-1/2" label="Costo Total" :disabled="true" />
          <textarea-input v-model="form.description" :error="form.errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Descripción" />
          <text-input v-model="form.material" :error="form.errors.material" class="pr-6 pb-8 w-full lg:w-1/2" label="Material" />
          <text-input v-model="form.unity" :error="form.errors.unity" class="pr-6 pb-8 w-full lg:w-1/2" label="Unidad de Medida" />
          <text-input v-model="form.color" :error="form.errors.color" class="pr-6 pb-8 w-full lg:w-1/2" label="Color" />
          <textarea-input v-model="form.classification" :error="form.errors.classification" class="pr-6 pb-8 w-full lg:w-1/2" label="Clasificación" />
          <textarea-input v-model="form.notes" :error="form.errors.notes" class="pr-6 pb-8 w-full lg:w-1/2" label="Notas" />
          <select-input v-model="form.contact_id" :error="form.errors.contact_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Proveedor">
            <option :value="null" />
            <option v-for="contact in contacts" :key="contact.id" :value="contact.id">{{ contact.name }}</option>
          </select-input>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Crear Producto</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TextareaInput from '../../Shared/TextareaInput'

export default {
  metaInfo: { title: 'Crear Producto' },
  components: {
    TextareaInput,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  props: {
    contacts: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        quantity: null,
        description: null,
        contact_id: null,
        unit_cost: null,
        total_cost: null,
        material: null,
        unity: null,
        color: null,
        classification: null,
        notes: null,
      }),
    }
  },
  methods: {
    updateTotal() {
      if (this.form.unit_cost && this.form.quantity) {
        this.form.total_cost = parseInt(this.form.quantity) * parseInt(this.form.unit_cost);
      }
    },
    store() {
      this.form.post(this.route('products.store'))
    },
  },
}
</script>
