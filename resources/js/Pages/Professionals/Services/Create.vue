<script setup>
import DashboardLayout from "@/UI/layouts/DashboardLayout.vue";
import BoxTitle from "@/UI/components/box-title/BoxTitle.vue";
import CardCustom from "@/UI/components/card/CardCustom.vue";
import {useForm} from "@inertiajs/vue3";

defineOptions({
    layout: DashboardLayout
})

const menuItems = ref([
    {
        name: 'Gestão de Serviços',
        url: route('services.index'),
        active: false,
    },
    {
        name: 'Novo Serviço',
        url: null,
        active: true,
    },
])

const form = useForm({
    name: '',
    description: '',
    duration: '',
    price: 0,
    time_extra: '',
})

function submit() {
    form.transform((data) => {
        data.price = data.price * 100
        return data
    }).post(route('services.store'))
}
</script>

<template>
    <Head title="Novo Serviço" />
    <div class="space-y-10 overflow-y-auto">
        <BoxTitle title="Gestão de Serviços" :menuItems="menuItems" />
        <CardCustom title="Gereciar Serviços" subtitle="Gerencie os serviços que você oferece">
            <template #button>
                <Link :href="route('services.index')" class="text-sm transition-all text-slate-400 flex items-center gap-2 hover:text-primary-500 hover:border-primary-500 border py-2 rounded-md px-4">
                    <i class="pi pi-arrow-left" />
                    <span>Voltar</span>
                </Link>
            </template>
            <form @submit.prevent="submit">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="flex flex-col gap-2">
                        <label for="name">Nome</label>
                        <InputText id="name" type="text" v-model="form.name" aria-describedby="name-help" :invalid="!!form.errors.name"/>
                        <small id="name-help" class="text-red-600" v-if="form.errors.name">{{form.errors.name}}</small>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="description">Descrição</label>
                        <InputText id="description" type="text" v-model="form.description" aria-describedby="description-help" :invalid="!!form.errors.description"/>
                        <small id="description-help" class="text-red-600" v-if="form.errors.description">{{form.errors.description}}</small>
                    </div>

                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-4">
                    <div class="flex flex-col gap-2">
                        <label for="price">Preço</label>
                        <InputNumber v-model="form.price" inputId="currency-pt" mode="currency" currency="BRL" locale="pt-BR" :invalid="!!form.errors.price"/>
                        <small id="price-help" class="text-red-600" v-if="form.errors.price">{{form.errors.price}}</small>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="duration">Duração (minutos)</label>
                        <InputText id="duration" type="number" v-model="form.duration" aria-describedby="duration-help" :invalid="!!form.errors.duration"/>
                        <small id="duration-help" class="text-red-600" v-if="form.errors.duration">{{form.errors.duration}}</small>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="time_extra">Tempo Extra (minutos)</label>
                        <InputText id="time_extra" type="number" v-model="form.time_extra" aria-describedby="time_extra-help" :invalid="!!form.errors.time_extra"/>
                        <small id="time_extra-help" class="text-red-600" v-if="form.errors.time_extra">{{form.errors.time_extra}}</small>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <Button label="Salvar" size="small" variant="primary" :loading="form.processing" icon="pi pi-save" type="submit"/>
                </div>
            </form>
        </CardCustom>
    </div>
</template>
