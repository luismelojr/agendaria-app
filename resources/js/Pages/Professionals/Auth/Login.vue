<script setup>
import AuthProfessionalsLayout from '@/UI/layouts/AuthProfessionalsLayout.vue'
import {useForm} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";

defineOptions({
    layout: AuthProfessionalsLayout,
})

const form = useForm({
    email: '',
    password: '',
})

function handleSubmit() {
    form.post(route('professionals.login.store'))
}
</script>

<template>
    <div class="space-y-10 overflow-y-auto">
        <div class="space-y-2">
            <h1 class="text-gray-900 font-bold text-2xl">Acesse sua conta</h1>
            <p class="text-sm text-gray-600">Preencha o formulário abaixo para acessar sua conta.</p>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="space-y-2">
                <div class="flex flex-col gap-2">
                    <label for="email">E-mail</label>
                    <InputText id="email" type="email" v-model="form.email" aria-describedby="email-help" :invalid="!!form.errors.email"/>
                    <small id="email-help" class="text-red-600" v-if="form.errors.email">{{form.errors.email}}</small>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password">Senha</label>
                    <Password
                        id="password"
                        v-model="form.password"
                        aria-describedby="password-help"
                        :invalid="!!form.errors.password"
                        toggle-mask
                        promptLabel="Escolha uma senha segura"
                        weakLabel="Fraca"
                        mediumLabel="Média"
                        strongLabel="Forte"
                    />
                    <small id="password-help" class="text-red-600" v-if="form.errors.password">{{form.errors.password}}</small>
                </div>
            </div>
            <Button type="submit" label="Acessar" variant="primary" class="w-full mt-10" :loading="form.processing"/>
            <div class="mt-4 text-center">
                <Link :href="route('professionals.register.show')" class="text-sm text-primary-300 hover:text-primary-500">Não possui uma conta? Acesse aqui.</Link>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
