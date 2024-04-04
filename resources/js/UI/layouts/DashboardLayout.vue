<script setup>
import {Link} from "@inertiajs/vue3";
import Logo from "@/modules/landpage/components/Logo/Logo.vue";
import NavigationMenu from "@/UI/layouts/components/NavigationMenu.vue";
import MenuUser from "@/UI/layouts/components/MenuUser.vue";


</script>

<template>
    <div class="flex flex-col gap-10">
        <div class="w-full py-4 border-b">
            <div class="container-new flex items-center gap-10">
                <Link :href="route('dashboard')">
                    <Logo class="w-6 h-6" />
                </Link>
                <NavigationMenu />
                <MenuUser />
            </div>
        </div>
        <div>
            aaa
        </div>
    </div>
</template>

<style scoped>

</style>
