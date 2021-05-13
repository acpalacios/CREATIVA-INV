<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Reports</h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form>
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input class="pr-6 pb-8 w-full lg:w-1/2" label="Fecha Inicio" />
          <text-input class="pr-6 pb-8 w-full lg:w-1/2" label="Fecha Final" />
        </div>
      </form>
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
  layout: Layout,
}
</script>
