<script setup>
import {computed, ref} from "vue";
import {usePage} from "@inertiajs/vue3";

const menu = ref()
const page = usePage()
const user = computed(() => {
    return page.props.auth.user
})

const items = ref([
    {
        label: 'Perfil',
        items: [
            {
                label: 'Perfil',
                icon: 'pi pi-home',
                href: route('dashboard'),
                routeActive: ['dashboard']
            }
        ]
    },
]);

function toggleMenu(event) {
    menu.value.toggle(event)
}
</script>

<template>
    <div class="ml-auto">
        <button type="button" @click="toggleMenu">
            <Avatar image="https://github.com/luismelojr.png" v-if="user.image_url"/>
            <Avatar :label="user.name[0]" v-else />
        </button>
        <Menu ref="menu" id="overlay_menu" :model="items" :popup="true" />
    </div>
</template>

<style scoped>

</style>
