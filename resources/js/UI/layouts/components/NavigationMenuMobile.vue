<script setup>
import {Link, router, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";


const page = usePage()
const user = computed(() => {
    return page.props.auth.user
})
const openMenu = ref(false)

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
        href: route('home'),
        routeActive: ['home']
    },
    {
        label: 'Cadastrar Horário de Atendimento',
        icon: 'pi pi-clock',
        href: route('dashboard'),
        routeActive: ['home']
    }
]);

const itemsProfile = ref([
    {
        label: 'Perfil',
        icon: 'pi pi-home',
        command: () => {
            router.visit(route('home'))
        }
    },
    {
        label: 'Sair',
        icon: 'pi pi-sign-out',
        command: () => {
            router.visit(route('professionals.logout'), {
                method: 'post'
            })
        }
    }
]);
</script>

<template>
    <Button @click="openMenu = true" class="flex md:hidden" size="small" outlined icon="pi pi-bars" aria-label="Open menu sidebar" type="button" />
    <Sidebar v-model:visible="openMenu" position="right" header="Agendaria" @click="openMenu = false" class="relative">
        <div class="flex h-full justify-between flex-col">
            <nav class="flex-1">
                <ul class="flex flex-col gap-2">
                    <li v-for="item in items" :key="item.label">
                        <Link
                            :href="item.href"
                            class="py-2 gap-2 flex items-center text-gray-500 text-sm"
                        >
                            <i :class="item.icon"></i>
                            <span>{{ item.label }}</span>
                        </Link>
                    </li>
                </ul>
            </nav>
            <div>
                <Menu ref="menu" id="overlay_menu" :model="itemsProfile" class="border-0 absolute bottom-0 left-0 w-full px-2">
                    <template #start>
                        <div class="p-2 border-b flex gap-2 items-center">
                            <div>
                                <Avatar image="https://github.com/luismelojr.png" v-if="user.image_url"/>
                                <Avatar :label="user.name[0]" v-else style="background: #433BCE; color: #FFF" />
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[0.8rem] text-gray-700 font-medium">{{ user.name }}</span>
                                <span class="text-[0.8rem] text-gray-500">{{ user.email }}</span>
                            </div>
                        </div>
                    </template>
                </Menu>
            </div>
        </div>
    </Sidebar>
</template>

<style scoped>

</style>
