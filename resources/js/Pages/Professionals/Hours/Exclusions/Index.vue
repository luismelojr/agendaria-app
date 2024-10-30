<script setup>
import DashboardLayout from "@/UI/layouts/DashboardLayout.vue";
import BoxTitle from "@/UI/components/box-title/BoxTitle.vue";
import CardCustom from "@/UI/components/card/CardCustom.vue";
import Empty from "@/UI/components/layout/empty.vue";
import { FilterMatchMode, FilterOperator } from 'primevue/api'
import queryString from 'query-string'
import FiltersChip from "@/UI/components/filters-chip/FiltersChip.vue";

const $helper = inject('$helper')

defineOptions({
    layout: DashboardLayout
})

const props = defineProps({
    exclusions: Object,
    filters: Object,
    sorts: Array,
})

const menuItems = ref([
    {
        name: 'Horários de Ausência',
        url: null,
        active: true,
    },
])

const list = reactive({
    results: props.exclusions,
    legends: {
        name: 'Name',
    },
    filters: {
        'name': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.LESS_THAN }] },
    },
    sort: {},
})

onMounted(() => {
    const sortValue = $helper.sorts.formatQuery(props.sorts)
    if (sortValue !== undefined && sortValue.length > 0) {
        list.sort = sortValue[0]
    }
    const value = $helper.filters.formatQuery(props.filters)
    if (value !== undefined && Object.keys(value).length > 0) {
        list.filters = value
    }

})

// Carrega a Lista de marcas
function loadItems() {
    const filters = $helper.filters.getQuery(list.filters)
    const sorts = $helper.sorts.getQuery(list.sort)
    const query = {filters, sorts, page: props.exclusions.current_page}
    router.get(route('exclusions.index', queryString.stringify(query)))
}

// ------------------------------------------------------------------------------------------------

// Filters && Sorts

const removeItemFilter = async (key) => {
    if (list.filters[key].constraints && Array.isArray(list.filters[key].constraints)) {
        // Define todos os valores em constraints como null, mantendo os matchModes existentes
        list.filters[key].constraints = list.filters[key].constraints.map(constraint => ({
            ...constraint,
            value: null
        }))
    } else {
        list.filters[key].value = null
    }
    await loadItems()
}

const setSort = async (sort) => {
    list.sort.field = sort.sortField
    list.sort.order = sort.sortOrder
    console.log(list.sort , 'doido')
    await loadItems()
}
</script>

<template>
    <Head title="Horários de Ausência" />
    <div class="space-y-10 overflow-y-auto">
        <BoxTitle title="Horários de Ausência" :menuItems="menuItems" />
        <CardCustom title="Horários de Ausência" subtitle="Horários de ausência para o profissional">
            <FiltersChip
                v-if="$helper.filters.isActive(list.filters)"
                :remove="removeItemFilter"
                :label="$helper.filters.getLabel"
                :filters="list.filters"
                :legends="list.legends"
            />
            <DataTable :resizableColumns="true" removableSort v-model:filters="list.filters" filterLocale="pt-BR" filterDisplay="menu" @sort="setSort" @update:filters="loadItems" :value="list.results.data" :sortField="list.sort.field" :sortOrder="list.sort.order" stripedRows tableStyle="min-width: 50rem">
                <template #empty>
                    <Empty />
                </template>
                <Column field="name" header="Nome" :showFilterOperator="false" :show-clear-button="false" :showFilterMatchModes="false" sortable>
                    <template #filter="{ filterModel }">
                        <Dropdown v-model="filterModel.matchMode" :options="$helper.filters.matchModeList('text')" optionLabel="label" optionValue="value" emptyMessage="Selecione o tipo" class="w-full mb-3" />
                        <InputText v-model="filterModel.value" type="text" placeholder="Informe o conteúdo" />
                    </template>
                </Column>
                <Column field="description" header="Descricao" :showFilterOperator="false" :showFilterMatchModes="false" sortable />
            </DataTable>
            <Button @click.prevent="loadItems">TEste</Button>
        </CardCustom>
    </div>
</template>

<style scoped>

</style>
