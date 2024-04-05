<script setup>


    import BreadcrumbCustom from "@/UI/components/breadcrumb/BreadcrumbCustom.vue";

    const props = defineProps({
        title: String,
        menuItems: Array
    })
</script>

<template>
    <div class="flex items-center justify-between">
        <h1 class="text-[#6c757d] font-bold text-[18px]">{{props.title}}</h1>
        <breadcrumb-custom :items="props.menuItems" />
    </div>
</template>

<style scoped>

</style>
