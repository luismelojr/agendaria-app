<script setup>

import IconProfessionalsAuth from "@/UI/components/icons/IconProfessionalsAuth.vue";
import Logo from "@/modules/landpage/components/Logo/Logo.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-3 w-full h-screen">
        <div class="w-full h-full p-10">
            <Link :href="route('home')">
                <Logo class="w-10 h-10"/>
            </Link>
            <div class="mt-16">
                <slot />
            </div>
        </div>
        <div class="w-full h-full bg-primary-500 col-span-2 m-0 hidden md:flex justify-center items-center relative">
            <IconProfessionalsAuth class="w-[25rem]" />
            <div class="w-2 h-2 bg-white/10 absolute top-10 right-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute top-10 right-14"></div>
            <div class="w-2 h-2 bg-white/10 absolute top-14 right-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute top-14 right-14"></div>

            <div class="w-2 h-2 bg-white/10 absolute top-20 right-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute top-20 right-14"></div>
            <div class="w-2 h-2 bg-white/10 absolute top-24 right-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute top-24 right-14"></div>

            <div class="w-2 h-2 bg-white/10 absolute bottom-10 left-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute bottom-10 left-14"></div>
            <div class="w-2 h-2 bg-white/10 absolute bottom-14 left-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute bottom-14 left-14"></div>

            <div class="w-2 h-2 bg-white/10 absolute bottom-20 left-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute bottom-20 left-14"></div>
            <div class="w-2 h-2 bg-white/10 absolute bottom-24 left-10"></div>
            <div class="w-2 h-2 bg-white/10 absolute bottom-24 left-14"></div>
        </div>
    </div>
</template>

<style scoped>

</style>
