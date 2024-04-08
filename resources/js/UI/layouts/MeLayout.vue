<script setup>
import Logo from '@/modules/landpage/components/Logo/Logo.vue'
import Toast from "@/UI/components/toasts/Toast.vue";
</script>

<template>
<div class="bg-gray-100 flex flex-col">
    <div class="w-full bg-white shadow">
        <div class="container-new py-4">
            <Logo class="w-8 h-8"/>
        </div>
    </div>
    <div class="container-new py-6 w-full h-full flex-1">
        <slot />
    </div>
    <Toast position="bottom-right"/>
</div>
</template>

<style scoped>

</style>
