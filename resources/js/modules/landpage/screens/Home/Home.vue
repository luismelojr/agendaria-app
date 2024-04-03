<script setup>
import { Link } from '@inertiajs/vue3'
import Logo from '@/modules/landpage/components/Logo/Logo.vue'
</script>

<template>
    <header class="container-new w-full py-4 flex justify-between items-center">
        <Link :href="route('home')">
            <Logo class="w-10 h-10"/>
        </Link>
        <nav class="gap-4 items-center hidden md:flex">
            <Link :href="route('home')" class="text-gray-500 hover:underline">
                Entrar como cliente
            </Link>
            <Link :href="route('home')">
                <Button label="Entrar como profissional" size="small" icon="pi pi-arrow-right" icon-pos="right"/>
            </Link>
        </nav>
        <button class="flex md:hidden">
            mobile
        </button>
    </header>
</template>

<style scoped>

</style>
