<script setup>
    import DashboardLayout from "@/UI/layouts/DashboardLayout.vue";
    import BoxTitle from "@/UI/components/box-title/BoxTitle.vue";
    import CardCustom from "@/UI/components/card/CardCustom.vue";

    defineOptions({
        layout: DashboardLayout
    })

    const props = defineProps({
        services: Object
    })

    const menuItems = ref([
        {
            name: 'Gestão de Serviços',
            url: null,
            active: true,
        },
    ])

    const loading = ref(false)

    function loadItems(value) {
        router.get(route('services.index'), {
            page: value.page + 1,
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
</script>

<template>
    <Head title="Gestão de Horários" />
    <div class="space-y-10 overflow-y-auto">
        <BoxTitle title="Gestão de Serviços" :menuItems="menuItems" />
        <CardCustom title="Gereciar Serviços" subtitle="Gerencie os serviços que você oferece">
            <DataTable
                :value="services.data"
                lazy
                paginator
                :rows="services.last_page"
                :loading="loading"
                :totalRecords="services.total"
                @page="onPage($event)"
                :first="services.current_page"
            >
                <Column field="id" header="ID" />
                <Column field="name" header="Nome" />
                <Column field="price" header="Preço">
                    <template #body="slot">
                        {{ Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(slot.data.price) }}
                    </template>
                </Column>
                <Column field="duration" header="Duração">
                    <template #body="slot">
                        {{ slot.data.duration }} minutos
                    </template>
                </Column>
            </DataTable>
        </CardCustom>
    </div>
</template>

<style scoped>

</style>
