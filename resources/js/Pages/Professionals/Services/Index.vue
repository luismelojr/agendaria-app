<script setup>
    import DashboardLayout from "@/UI/layouts/DashboardLayout.vue";
    import BoxTitle from "@/UI/components/box-title/BoxTitle.vue";
    import CardCustom from "@/UI/components/card/CardCustom.vue";
    import {useConfirm} from "primevue/useconfirm";
    import ConfirmPopup from 'primevue/confirmpopup';
    import Pagination from "@/UI/components/pagination/Pagination.vue";
    import {watchDebounced} from "@vueuse/core";

    defineOptions({
        layout: DashboardLayout
    })

    const confirm = useConfirm()

    const props = defineProps({
        services: Object,
        query: Object,
    })

    const menuItems = ref([
        {
            name: 'Gestão de Serviços',
            url: null,
            active: true,
        },
    ])

    const loading = ref(false)
    const search = ref(props.query.search || '')

    watchDebounced(search, (value) => {
        loadItems()
    }, {debounce: 500})

    function loadItems() {
        router.get(route('services.index'), {
            page: props.services.current_page,
            search: search.value,
        }, {
            onStart: () => {
                loading.value = true
            },
            onFinish: () => {
                loading.value = false
            },
        })
    }

    function onPage(event) {
        loadItems(event)
    }

    function onDelete(event, item) {
        confirm.require({
            target: event.currentTarget,
            message: 'Deseja realmente excluir este serviço?',
            icon: 'pi pi-exclamation-circle',
            acceptIcon: 'pi pi-check mr-2',
            rejectIcon: 'pi pi-times mr-2',
            rejectClass: '!text-sm !py-2 !px-3',
            acceptLabel: 'Sim',
            rejectLabel: 'Não',
            acceptClass: '!bg-transparent !text-primary-500 hover:!bg-primary-300/20 !text-sm !py-2 !px-3',
            accept: () => {
                destroy(item)
            },
        });
    }

    function destroy(id) {
        router.delete(route('services.destroy', id), {
            onStart: () => {
                loading.value = true
            },
            onFinish: () => {
                loading.value = false
            },
        })
    }

    function removeFilters() {
        search.value = ''
        loadItems()
    }
</script>

<template>
    <Head title="Gestão de Horários" />
    <div class="space-y-10 overflow-y-auto">
        <BoxTitle title="Gestão de Serviços" :menuItems="menuItems" />
        <CardCustom title="Gereciar Serviços" subtitle="Gerencie os serviços que você oferece">
            <template #button>
                <Link :href="route('services.create')" class="text-sm bg-primary-500 flex items-center text-white py-2 px-4 rounded-md hover:bg-primary-700 transition-all gap-2">
                    <i class="pi pi-plus" />
                    <span>Novo Serviço</span>
                </Link>
            </template>
            <div class="py-2 w-full">
                <div class="flex justify-end items-center gap-2">
                    <span class="relative">
                        <i class="pi pi-search absolute top-2/4 -mt-2 left-3 text-surface-400 dark:text-surface-600" />
                        <InputText v-model="search" placeholder="Buscar com nome, preço ou duração" class="pl-10 w-full md:w-[400px]" size="small" />
                    </span>
                    <button @click="removeFilters" v-if="!!search" class="text-sm transition-all text-slate-400 flex items-center gap-2 hover:text-primary-500 hover:border-primary-500 border py-2 rounded-md px-4">
                        <i class="pi pi-trash" />
                        <span>Limpar Filtros</span>
                    </button>
                </div>
            </div>
            <div v-if="services.data.length > 0">
                <div class="overflow-auto ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <div v-if="loading">
                        <ProgressBar mode="indeterminate" style="height: 4px"></ProgressBar>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 !pl-4 !pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nome</th>
                            <th scope="col" class="!px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Preço</th>
                            <th scope="col" class="!px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Duração</th>
                            <th scope="col" class="!px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tempo Extra</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        <tr v-for="item in services.data">
                            <td class="whitespace-nowrap py-4 !pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{item.name}}</td>
                            <td class="whitespace-nowrap !px-3 py-4 text-sm text-gray-500">{{ Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(item.price) }}</td>
                            <td class="whitespace-nowrap !px-3 py-4 text-sm text-gray-500">{{item.duration}} minutos</td>
                            <td class="whitespace-nowrap !px-3 py-4 text-sm text-gray-500">{{item.time_extra === 0 ? 'Sem tempo extra' : `${item.time_extra} minutos`}}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium flex gap-2 items-center sm:pr-0">
                                <Link :href="route('services.edit', {service: item})" class="text-sm text-slate-400 flex items-center gap-2 hover:text-primary-500">
                                    <i class="pi pi-pencil" />
                                    <span>Editar</span>
                                </Link>
                                <div>
                                    <ConfirmPopup>
                                        <template #message="slotProps">
                                            <div class="flex flex-col items-center w-full gap-3 border-b border-surface-200 dark:border-surface-700 p-3 mb-6">
                                                <i :class="slotProps.message.icon" class="text-6xl text-primary-500"></i>
                                                <p>{{ slotProps.message.message }}</p>
                                            </div>
                                        </template>
                                    </ConfirmPopup>
                                    <button type="button" @click="onDelete($event, item.id)" class="text-sm text-slate-400 flex items-center gap-2 hover:text-red-500">
                                        <i class="pi pi-trash" />
                                        <span>Excluir</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :data="services" />
            </div>
            <div v-else class="py-10 flex items-center justify-center flex-col">
                <i class="pi pi-shopping-bag text-4xl text-slate-400 dark:text-slate-500" />
                <h3 class="text-sm font-semibold text-gray-900 mt-2">{{!!search ? 'Nenhum serviço encontrado' : 'Nenhum serviço cadastrado'}}</h3>
                <p class="mt-1 text-sm text-gray-500">{{!!search ? 'Não encontramos nenhum serviço com os filtros aplicados.' : 'Cadastre um novo serviço para começar a gerenciar.'}}</p>
                <div>
                    <button @click="removeFilters" v-if="!!search" class="text-sm transition-all text-slate-400 flex items-center gap-2 hover:text-primary-500 hover:border-primary-500 border py-2 rounded-md px-4 mt-4">
                        <i class="pi pi-trash" />
                        <span>Limpar Filtros</span>
                    </button>
                    <Link v-else :href="route('services.create')" class="text-sm transition-all text-slate-400 flex items-center gap-2 hover:text-primary-500 hover:border-primary-500 border py-2 rounded-md px-4 mt-4">
                        <i class="pi pi-plus" />
                        <span>Novo Serviço</span>
                    </Link>
                </div>
            </div>
        </CardCustom>
    </div>
</template>
