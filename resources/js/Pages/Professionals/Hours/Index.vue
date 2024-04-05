<script setup>
    import DashboardLayout from "@/UI/layouts/DashboardLayout.vue";
    import CardCustom from "@/UI/components/card/CardCustom.vue";
    import BoxTitle from "@/UI/components/box-title/BoxTitle.vue";

    defineOptions({
        layout: DashboardLayout
    })

    const props = defineProps({
        schedule: Object
    })

    const menuItems = ref([
        {
            name: 'Gestão de Horários',
            url: null,
            active: true,
        },
    ])

    const days = ref([
        {
            title: 'Segunda-feira',
            start: props.schedule?.monday_starts_at || '',
            end: props.schedule?.monday_ends_at || '',
            isActive: !!props.schedule?.monday_starts_at,
            fieldStart: 'monday_starts_at',
            fieldEnd: 'monday_ends_at',
        },
        {
            title: 'Terça-feira',
            start: props.schedule?.tuesday_starts_at || '',
            end: props.schedule?.tuesday_ends_at || '',
            isActive: !!props.schedule?.tuesday_starts_at,
            fieldStart: 'tuesday_starts_at',
            fieldEnd: 'tuesday_ends_at',
        },
        {
            title: 'Quarta-feira',
            start: props.schedule?.wednesday_starts_at || '',
            end: props.schedule?.wednesday_ends_at || '',
            isActive: !!props.schedule?.wednesday_starts_at,
            fieldStart: 'wednesday_starts_at',
            fieldEnd: 'wednesday_ends_at',
        },
        {
            title: 'Quinta-feira',
            start: props.schedule?.thursday_starts_at || '',
            end: props.schedule?.thursday_ends_at || '',
            isActive: !!props.schedule?.thursday_starts_at,
            fieldStart: 'thursday_starts_at',
            fieldEnd: 'thursday_ends_at',
        },
        {
            title: 'Sexta-feira',
            start: props.schedule?.friday_starts_at || '',
            end: props.schedule?.friday_ends_at || '',
            isActive: !!props.schedule?.friday_starts_at,
            fieldStart: 'friday_starts_at',
            fieldEnd: 'friday_ends_at',
        },
        {
            title: 'Sábado',
            start: props.schedule?.saturday_starts_at || '',
            end: props.schedule?.saturday_ends_at || '',
            isActive: !!props.schedule?.saturday_starts_at,
            fieldStart: 'saturday_starts_at',
            fieldEnd: 'saturday_ends_at',
        },
        {
            title: 'Domingo',
            start: props.schedule?.sunday_starts_at || '',
            end: props.schedule?.sunday_ends_at || '',
            isActive: !!props.schedule?.sunday_starts_at,
            fieldStart: 'sunday_starts_at',
            fieldEnd: 'sunday_ends_at',
        },
    ])

    const form = useForm({
        monday_starts_at: days.value[0].start,
        monday_ends_at: days.value[0].end,
        tuesday_starts_at: days.value[1].start,
        tuesday_ends_at: days.value[1].end,
        wednesday_starts_at: days.value[2].start,
        wednesday_ends_at: days.value[2].end,
        thursday_starts_at: days.value[3].start,
        thursday_ends_at: days.value[3].end,
        friday_starts_at: days.value[4].start,
        friday_ends_at: days.value[4].end,
        saturday_starts_at: days.value[5].start,
        saturday_ends_at: days.value[5].end,
        sunday_starts_at: days.value[6].start,
        sunday_ends_at: days.value[6].end,
    })

    function handleSubmit() {
        form.transform((data) => {
            return {
                monday_starts_at: days.value[0].isActive ? days.value[0].start : null,
                monday_ends_at: days.value[0].isActive ? days.value[0].end : null,
                tuesday_starts_at: days.value[1].isActive ? days.value[1].start : null,
                tuesday_ends_at: days.value[1].isActive ? days.value[1].end : null,
                wednesday_starts_at: days.value[2].isActive ? days.value[2].start : null,
                wednesday_ends_at: days.value[2].isActive ? days.value[2].end : null,
                thursday_starts_at: days.value[3].isActive ? days.value[3].start : null,
                thursday_ends_at: days.value[3].isActive ? days.value[3].end : null,
                friday_starts_at: days.value[4].isActive ? days.value[4].start : null,
                friday_ends_at: days.value[4].isActive ? days.value[4].end : null,
                saturday_starts_at: days.value[5].isActive ? days.value[5].start : null,
                saturday_ends_at: days.value[5].isActive ? days.value[5].end : null,
                sunday_starts_at: days.value[6].isActive ? days.value[6].start : null,
                sunday_ends_at: days.value[6].isActive ? days.value[6].end : null,
            }
        }).put(route('hours.update'))
    }
</script>

<template>
    <Head title="Gestão de Horários" />
    <div class="space-y-10 overflow-y-auto">
        <BoxTitle title="Gestão de Horários" :menuItems="menuItems" />
        <CardCustom title="Gereciar Horários" subtitle="Configure os horários de atendimento da sua agenda.">
            <form class="space-y-2.5" @submit.prevent="handleSubmit">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <div v-for="day in days" :key="day.title" class="border p-2 rounded-sm flex flex-col w-full">
                        <div class="flex gap-2 items-center justify-between">
                        <span class="text-sm text-gray-400" :class="{'text-gray-800': day.isActive}">
                            {{day.title}}
                        </span>
                            <InputSwitch v-model="day.isActive" size="small"/>
                        </div>
                        <div v-if="day.isActive" class="flex flex-col gap-2 items-start mt-4 pt-4 border-t w-full">
                            <div class="flex flex-col gap-2 w-full">
                                <label :for="`${day.title}-start`" class="text-sm text-slate-500">{{day.title}} - Inícia</label>
                                <InputMask
                                    v-model="day.start"
                                    mask="99:99"
                                    :name="day.fieldStart"
                                    :id="`${day.title}-start`"
                                    :invalid="!!form.errors[day.fieldStart]"
                                />
                                <small :id="`${day.title}-start-help`" class="text-red-600" v-if="form.errors[day.fieldStart]">{{form.errors[day.fieldStart]}}</small>
                            </div>

                            <div class="flex flex-col gap-2 w-full">
                                <label :for="`${day.title}-end`" class="text-sm text-slate-500">{{day.title}} - Términa</label>
                                <InputMask
                                    v-model="day.end"
                                    mask="99:99"
                                    :name="day.fieldEnd"
                                    :id="`${day.title}-end`"
                                    :invalid="!!form.errors[day.fieldEnd]"
                                />
                                <small :id="`${day.title}-end-help`" class="text-red-600" v-if="form.errors[day.fieldEnd]">{{form.errors[day.fieldEnd]}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end w-full">
                    <Button label="Salvar" size="small" variant="primary" :loading="form.processing" icon="pi pi-save" type="submit"/>
                </div>
            </form>
        </CardCustom>
    </div>
</template>

<style scoped>

</style>
