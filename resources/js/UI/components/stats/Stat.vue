<script setup>
    const props = defineProps({
        title: String,
        value: String,
        icon: String,
        href: String
    });
</script>

<template>
    <div class="rounded-lg bg-white shadow">
        <div class="flex items-start gap-4 px-4 p-6">
            <div class="bg-primary-500 rounded-md p-3 flex justify-center items-center">
                <i :class="props.icon" class="text-white text-2xl"/>
            </div>
            <div class="flex-1">
                <p class="truncate text-sm font-medium text-gray-500">{{props.title}}</p>
                <p class="text-2xl font-semibold text-gray-900">{{props.value}}</p>
            </div>
        </div>
        <Link :href="props.href" class="w-full bg-gray-50 flex p-4 text-sm text-primary-400 hover:text-primary-500">
            Ver detalhes
        </Link>
    </div>
</template>

<style scoped>

</style>
