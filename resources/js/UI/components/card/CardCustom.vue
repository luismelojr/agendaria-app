<script setup>
const props = defineProps({
    title: String,
    subtitle: String,
    isNewButton: Boolean,
    buttonText: String,
    buttonLink: String,
})
</script>

<template>
    <div class="bg-white shadow rounded-lg">
        <div class="border-b w-full py-6 px-4 flex items-center justify-between">
            <div>
                <h1 class="text-gray-700 text-md">{{title}}</h1>
                <p class="text-sm text-gray-400">{{subtitle}}</p>
            </div>
            <div>
                <slot name="button"/>
            </div>
        </div>

        <div class="py-6 px-4">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>

</style>
