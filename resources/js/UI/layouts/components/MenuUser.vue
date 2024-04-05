<script setup>
import {computed, ref} from "vue";
import {usePage, router} from "@inertiajs/vue3";

const menu = ref()
const page = usePage()
const user = computed(() => {
    return page.props.auth.user
})

const items = ref([
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

function toggleMenu(event) {
    menu.value.toggle(event)
}
</script>

<template>
    <div class="ml-auto">
        <button type="button" @click="toggleMenu">
            <Avatar image="https://github.com/luismelojr.png" v-if="user.image_url"/>
            <Avatar :label="user.name[0]" v-else style="background: #433BCE; color: #FFF" />
        </button>
        <Menu ref="menu" id="overlay_menu" :model="items" :popup="true">
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
</template>

<style scoped>

</style>
