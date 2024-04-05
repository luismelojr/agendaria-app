<script setup>
defineProps({
    items: {
        type: Array,
        required: true,
    },
})
</script>

<template>
    <ul class="flex items-center gap-2 flex-wrap">
        <li>
            <Link
                :href="route('dashboard')"
                class="text-gray-500 text-[13px] hover:text-primary-500"
            >Dashboard
            </Link>
        </li>
        <i class="pi pi-angle-right text-text-menu text-[10px]" />
        <li
            v-for="(item, index) in items"
            :key="index"
            class="flex items-center gap-2"
        >
            <Link
                :href="item.url"
                class="text-gray-500 text-[13px] hover:text-primary-500"
                v-if="!item.active"
            >{{ item.name }}
            </Link>
            <p v-else class="text-[#334155] text-[13px]">{{ item.name }}</p>
            <i class="pi pi-angle-right text-text-menu text-[10px]" v-if="index < items.length - 1" />
        </li>
    </ul>
</template>

<style scoped>
span,
i {
    color: rgba(108, 117, 125, 0.75);
}
</style>
