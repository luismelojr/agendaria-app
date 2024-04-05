<script setup>
import {Link} from "@inertiajs/vue3";
import Logo from "@/modules/landpage/components/Logo/Logo.vue";
import NavigationMenu from "@/UI/layouts/components/NavigationMenu.vue";
import MenuUser from "@/UI/layouts/components/MenuUser.vue";
import NavigationMenuMobile from "@/UI/layouts/components/NavigationMenuMobile.vue";
import Toast from "@/UI/components/toasts/Toast.vue";


</script>

<template>
    <div class="flex flex-col h-screen gap-10 bg-[#F3F4F6]">
        <div class="w-full py-4 border-b bg-white">
            <div class="container-new flex items-center gap-10">
                <Link :href="route('dashboard')">
                    <Logo class="w-8 h-8" />
                </Link>
                <div class="hidden md:flex items-center w-full">
                    <NavigationMenu />
                    <MenuUser />
                </div>
                <div class="flex w-full md:hidden justify-end">
                    <NavigationMenuMobile />
                </div>
            </div>
        </div>
        <div class="container-new h-full flex-1">
            <slot />
        </div>
    </div>
    <Toast />
</template>

<style scoped>

</style>
