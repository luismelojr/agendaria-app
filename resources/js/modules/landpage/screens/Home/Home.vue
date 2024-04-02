<script setup>
import { Link } from '@inertiajs/vue3'
import Logo from '@/modules/landpage/components/Logo/Logo.vue'
</script>

<template>
    <header class="container w-full py-4 flex justify-between items-center">
        <Link :href="route('home')">
            <Logo class="w-10 h-10"/>
        </Link>
        <nav>
            <Link :href="route('home')">
                <Button label="Cadastrar agenda" size="small" icon="pi pi-arrow-right" icon-pos="right"/>
            </Link>
        </nav>
    </header>
</template>

<style scoped>

</style>
