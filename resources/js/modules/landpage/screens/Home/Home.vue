<script setup>
import { Link } from '@inertiajs/vue3'
import Logo from '@/modules/landpage/components/Logo/Logo.vue'
import {ref} from "vue";

const openMenu = ref(false)

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
        <Button @click="openMenu = true" class="flex md:hidden" size="small" outlined icon="pi pi-bars" aria-label="Open menu sidebar" type="button" />
        <Sidebar v-model:visible="openMenu" position="right" :show-close-icon="false">
            <ul class="flex flex-col w-full gap-2">
                <li class="w-full">
                    <Link href="/" class="text-gray-500 rounded-md hover:bg-primary-100/10 hover:text-primary-500 w-full flex transition-all items-center gap-4 py-4 px-2 group">
                        Entrar como cliente
                        <span class="hidden group-hover:block transition-all"><i class="pi pi-arrow-right"/></span>
                    </Link>
                </li>
                <li class="w-full">
                    <Link href="/" class="text-gray-500 rounded-md hover:bg-primary-100/10 hover:text-primary-500 w-full flex transition-all items-center gap-4 py-4 px-2 group">
                        Entrar como profissional
                        <span class="hidden group-hover:block transition-all"><i class="pi pi-arrow-right"/></span>
                    </Link>
                </li>
            </ul>
        </Sidebar>
    </header>
</template>

<style scoped>

</style>
