<script setup>
import {ref} from "vue";
import {Link, usePage} from "@inertiajs/vue3";

const page = usePage()

function isActivePage(routeName) {
    const value = routeName.map((item) => route().current(item))
    return value.includes(true)
}

const items = ref([
    {
        label: 'Dashboard',
        icon: 'pi pi-home',
        href: route('dashboard'),
        routeActive: 'dashboard',
        active: isActivePage(['dashboard'])
    },
    {
        label: 'Gerenciar Serviço',
        icon: 'pi pi-shopping-bag',
        href: route('services.index'),
        routeActive: 'services.*',
        active: isActivePage(['services.*'])
    },
    {
        label: 'Gerenciar Horário de Atendimento',
        icon: 'pi pi-clock',
        href: route('hours.show'),
        routeActive: 'hours.*',
        active: isActivePage(['hours.*'])
    }
]);

watch(page, (value) => {
    if (value.url.split('/').length >= 3) {
        items.value.forEach((item) => {
            item.active = item.routeActive === `${value.url.split('/')[2]}.*`;
        })
    } else {
        items.value.forEach((item) => {
            item.active = item.routeActive === 'dashboard';
        })
    }
})


</script>

<template>
    <nav class="flex-1">
        <ul class="flex items-center gap-2">
            <li v-for="item in items" :key="item.label">
                <Link
                    :href="item.href"
                    class="py-2 px-3 hover:bg-slate-100 rounded-md gap-2 flex items-center text-gray-500 text-sm"
                    :class="{'bg-primary-500/10 text-primary-500': item.active}"
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
