<script setup>
    import AuthProfessionalsLayout from '@/UI/layouts/AuthProfessionalsLayout.vue'
    import {useForm} from "@inertiajs/vue3";
    import {Link} from "@inertiajs/vue3";

    const props = defineProps({
        plan: String
    })

    defineOptions({
        layout: AuthProfessionalsLayout,
    })

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        phone: '',
        date_of_birth: '',
        plan: props.plan,
    })

    function handleSubmit() {
        form.transform((data) => {
            return {
                ...data,
                date_of_birth: data.date_of_birth.split('/').reverse().join('-'),
                phone: data.phone.replace(/\D/g, '')
            }
        }).post(route('professionals.register.store'))
    }
</script>

<template>
    <div class="space-y-10 overflow-y-auto">
        <div class="space-y-2">
            <h1 class="text-gray-900 font-bold text-2xl">Cadastre-se como profissional</h1>
            <p class="text-sm text-gray-600">Preencha o formulário abaixo para se cadastrar como profissional.</p>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="space-y-2">
                <div class="flex flex-col gap-2">
                    <label for="name">Nome</label>
                    <InputText id="name" v-model="form.name" aria-describedby="name-help" :invalid="!!form.errors.name"/>
                    <small id="name-help" class="text-red-600" v-if="form.errors.name">{{form.errors.name}}</small>
                </div>
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
                <div class="flex flex-col gap-2">
                    <label for="password">Confirme a senha</label>
                    <Password
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        aria-describedby="password_confirmation-help"
                        :invalid="!!form.errors.password_confirmation"
                        toggle-mask
                        promptLabel="Escolha uma senha segura"
                        weakLabel="Fraca"
                        mediumLabel="Média"
                        strongLabel="Forte"
                    />
                    <small id="password_confirmation-help" class="text-red-600" v-if="form.errors.password_confirmation">{{form.errors.password_confirmation}}</small>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="phone">Telefone</label>
                    <InputMask
                        id="phone"
                        type="text"
                        mask="(99) 9 9999-9999"
                        v-model="form.phone"
                        aria-labelledby="phone"
                        :invalid="!!form.errors.phone"
                    />
                    <small id="phone-help" class="text-red-600" v-if="form.errors.phone">{{form.errors.phone}}</small>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="date_of_birth">Data de nascimento</label>
                    <InputMask
                        id="date_of_birth"
                        type="text"
                        mask="99/99/9999"
                        v-model="form.date_of_birth"
                        aria-labelledby="Age"
                        :invalid="!!form.errors.date_of_birth"/>
                    <small id="date_of_birth-help" class="text-red-600" v-if="form.errors.date_of_birth">{{form.errors.date_of_birth}}</small>
                </div>
            </div>
            <Button type="submit" label="Cadastrar" variant="primary" class="w-full mt-10" :loading="form.processing"/>
            <div class="mt-4 text-center">
                <Link :href="route('professionals.login.show')" class="text-sm text-primary-300 hover:text-primary-500">Já possui uma conta? Faça login</Link>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
