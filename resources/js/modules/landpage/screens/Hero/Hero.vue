<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="max-w-screen overflow-hidden h-[500px] bg-gray-900 flex flex-col justify-center items-center text-center">
        <h1 class="mt-10 text-2xl font-bold tracking-tight text-white sm:text-6xl">Agendamento eficiente e sem enrolação.</h1>
        <p class="mt-6 text-lg leading-8 text-gray-300">Aumente sua eficiência e ofereça uma experiência conveniente para seus clientes com nosso sistema de agendamento.</p>
        <div class="mt-4">
            <Link :href="route('login')">
                <Button label="Entrar como profissional" size="small" icon="pi pi-arrow-right" icon-pos="right"/>
            </Link>
        </div>
    </div>
</template>

<style scoped>

</style>
