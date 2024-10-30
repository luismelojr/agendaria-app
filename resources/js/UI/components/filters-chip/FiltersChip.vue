<script setup>
const props = defineProps({
    remove: {
        type: Function,
        default: () => {}
    },
    label: {
        type: Function,
        default: () => {}
    },
    filters: {
        type: Object,
        default: {}
    },
    legends: {
        type: Object,
        default: {}
    }
})
</script>

<template>
    <div class="bg-gray-50 p-3">
        <strong>Filtros:</strong>
        <span v-for="(item, key) in filters" :key="key">
          <!-- Verifica se há constraints e se todos os values são diferentes de null -->
          <Chip v-if="item.constraints && item.constraints.some(constraint => constraint.value !== null)"
                class="ml-1"
                @remove="remove(key)"
                removable
                :label="label(key, legends[key], item)" />
            <!-- Exibe Chip se item.value não for null e não tiver constraints -->
          <Chip v-else-if="!item.constraints && item.value !== null"
                class="ml-1"
                @remove="remove(key)"
                removable
                :label="label(key, legends[key], item)" />
        </span>
    </div>
</template>
