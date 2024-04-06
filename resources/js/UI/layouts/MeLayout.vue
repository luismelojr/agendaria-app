<script setup>
import Logo from '@/modules/landpage/components/Logo/Logo.vue'
</script>

<template>
<div class="bg-gray-100 flex flex-col w-ful h-full">
    <div class="w-full bg-white shadow">
        <div class="container-new py-4">
            <Logo class="w-8 h-8"/>
        </div>
    </div>
    <div class="container-new py-6">
        <slot />
    </div>
</div>
</template>

<style scoped>

</style>
