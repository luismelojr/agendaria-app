<script setup>
const props = defineProps({
  message: {
    type: String,
    default: 'Oops... Nenhum resultado encontrado'
  }
})
</script>

<template>
  <div class="py-10 text-center">
    <h2 class="m-0 mt-8 text-transform text-gray-400">{{ props.message }}</h2>
  </div>
</template>

<style lang="scss" scoped>
</style>
