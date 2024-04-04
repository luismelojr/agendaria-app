<script setup>
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";

const items = ref([
    {
        label: 'Dashboard',
        icon: 'pi pi-home',
        href: route('dashboard'),
        routeActive: ['dashboard']
    },
    {
        label: 'Cadastrar Serviço',
        icon: 'pi pi-shopping-bag',
        href: route('dashboard'),
        routeActive: ['home']
    },
    {
        label: 'Cadastrar Horário de Atendimento',
        icon: 'pi pi-clock',
        href: route('dashboard'),
        routeActive: ['home']
    }
]);

function isActivePage(routeName) {
    const value = routeName.map((item) => route().current(item))
    return value.includes(true)
}
</script>

<template>
    <nav class="flex-1">
        <ul class="flex items-center gap-3">
            <li v-for="item in items" :key="item.label">
                <Link
                    :href="item.href"

                    class="py-2 px-4 hover:bg-slate-100 rounded-md gap-2 flex items-center text-gray-500 text-sm"
                    :class="{'bg-primary-500/10 text-primary-500': isActivePage(item.routeActive)}"
                >
                    <i :class="item.icon"></i>
                    <span>{{ item.label }}</span>
                </Link>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
