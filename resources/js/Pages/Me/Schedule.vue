<script setup>
    import MeLayout from "@/UI/layouts/MeLayout.vue";
    import {easepick, LockPlugin} from "@easepick/bundle";
    import styleEasepick from "@easepick/bundle/dist/index.css?url";
    import customStyleEasepicker from '../../../css/vendor/easepick.css?url'
    import pluralize from 'pluralize'
    import {router, useForm} from "@inertiajs/vue3";
    import {useToast} from "primevue/usetoast";

    defineOptions({
        layout: MeLayout
    })

    const props = defineProps({
        user: Object,
        service: Object,
        availability: Array,
        date: String,
        calendar: String
    })

    const easepickerRef = ref()
    let picker = null
    const slots = ref([])
    const userRef = ref(null)
    const loading = ref(false)
    const loadingCode = ref(false)
    const form = useForm({
        service_id: props.service.id,
        user_id: props.user.id,
        datetime: null,
        phone: null,
        name: '',
        client_id: null
    })
    const codeValidation = ref(false)
    const code = ref(null)
    const codeErrors = ref('')
    const toast = useToast()
    const phoneDisabled = ref(false)

    const createPicker = () => {
        picker = new easepick.create({
            element: easepickerRef.value,
            readonly: true,
            lang: 'pt-BR',
            date: props.date,
            inline: true,
            zIndex: 50,
            css: [styleEasepick, customStyleEasepicker],
            plugins: [LockPlugin],
            LockPlugin: {
                minDate: new Date(),
                filter (date) {
                    return !props.availability.find(a => a.date === date.format('YYYY-MM-DD'))
                }
            },
            setup(picker) {
                picker.on('view', (e) => {
                    const { view, date, target } = e.detail
                    const dateString = date ? date.format('YYYY-MM-DD') : null
                    const availability = props.availability.find(a => a.date === dateString)

                    if (view === 'CalendarDay' && availability) {
                        const span = target.querySelector('.day-slots') || document.createElement('span')
                        span.className = 'day-slots'
                        span.innerHTML = pluralize('vaga', Object.keys(availability.slots).length, true)
                        target.append(span)
                    }

                })
            }
        })
    }

    const setSlots = (date) => {
        slots.value = props.availability.find(a => a.date === date).slots
    }

    const setDatetime = (datetime) => {
        if (form.datetime === datetime) {
            form.datetime = null
        } else {
            form.datetime = datetime
            userRef.value.scrollIntoView({behavior: 'smooth'})
        }
    }

    onMounted(() => {
        createPicker()
        setSlots(props.date)
        picker.on('select', (e) => {
            setSlots(e.detail.date.format('YYYY-MM-DD'))
        })
        picker.on('render', (e) => {
            if (e.detail.view === 'Container' && e.detail.date.format('YYYY-MM-DD') !== props.calendar) {
                router.reload({
                    data: {
                        calendar: e.detail.date.format('YYYY-MM-DD')
                    },
                    only: ['availability', 'calendar', 'date'],
                    onSuccess: () => {
                        picker.renderAll()
                    }
                })
            }
        })
    })

    const handleSendCode = async () => {
        loading.value = true
        const response = await axios.post(route('client.code.send'), {
            phone: form.phone.replace(/\D/g, '')
        })
        loading.value = false

        toast.add({severity: 'success', summary: 'Sucesso', detail: response.data.message, life: 5000})
        phoneDisabled.value = true
    }

    const handleValidationCode = async () => {
        try {
            loadingCode.value = true
            const response = await axios.post(route('client.code.validation'), {
                phone: form.phone.replace(/\D/g, ''),
                code: code.value
            })

            codeErrors.value = ''
            codeValidation.value = true
            form.client_id = response.data.client.id
            toast.add({severity: 'success', summary: 'Sucesso', detail: response.data.message, life: 5000})
        } catch (e) {
            codeErrors.value = e.response.data.message
            toast.add({severity: 'error', summary: 'Error', detail: e.response.data.message, life: 5000})
        } finally {
            loadingCode.value = false
        }
    }

    const handleSubmit = () => {
        form.transform((data) => {
            data.phone = data.phone.replace(/\D/g, '')
            return data
        }).post(route('appointments.store'))
    }
</script>

<template>
    <div class="flex flex-col">
        <div class="w-full relative h-[300px]">
            <img :src="user.config.banner_image" alt="" class="w-full h-full rounded-md">
            <div class="absolute left-[50%] -bottom-14 transform translate-x-[-50%]">
                <Avatar icon="pi pi-user" class="w-[120px] h-[120px] text-[40px]" shape="circle" v-if="user.image_url"/>
                <Avatar image="https://github.com/luismelojr.png" class="w-[120px] h-[120px] text-[40px]" shape="circle" v-else/>
            </div>
        </div>
        <div class="w-full bg-white py-6 rounded-md mt-8 flex justify-center items-center">
            <div class="flex flex-col items-center">
                <h1 class="text-sm text-slate-500">{{ user.name }}</h1>
                <div class="mt-4 flex gap-4 items-center">
                <span class="flex items-center gap-2 text-[12px] text-slate-400">
                    <i class="pi pi-shopping-bag" />
                    {{user.services.length}} {{user.services.length > 1 ? 'serviços' : 'serviço'}}
                </span>
                </div>
            </div>
        </div>
        <div class="mt-8 bg-white p-4">
            <div class="border-b p-2 flex justify-between items-center">
                <h2 class="text-md text-slate-500 flex items-center gap-2">
                    <i class="pi pi-shopping-bag" :style="`color: ${user.config.color_primary}` "/>
                    Serviço selecionado
                </h2>
                <Link :href="route('me.home', {'email': user.email})" class="text-sm transition-all text-slate-400 flex items-center gap-2 hover:text-primary-500 hover:border-primary-500 border py-2 rounded-md px-4">
                    <i class="pi pi-arrow-left" />
                    <span>Voltar</span>
                </Link>
            </div>
            <div class="p-2 w-full border rounded-md flex justify-between mt-4">
                <div>
                    <div>
                        <i class="pi pi-shopping-bag text-[20px]" :style="`color: ${user.config.color_primary}` "/>
                        <h3 class="block text-gray-700 leading-snug font-semibold text-lg mt-3" >{{service.name}}</h3>
                        <p class="text-dark-blue opacity-75 text-sm mt-4 line-clamp-2">{{service.description}}</p>
                        <div class="flex items-center gap-4 mt-4">
                            <div class="space-x-1">
                                <i class="pi pi-clock text-[12px] text-slate-400" />
                                <span class="text-slate-400 text-[12px]">{{service.duration}} minutos</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-2 mb-10 text-xl text-slate-900">{{Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(service.price)}}</p>
            </div>
        </div>

        <div class="mt-8 bg-white p-4">
            <div class="border-b p-2 flex justify-between items-center">
                <h2 class="text-md text-slate-500 flex items-center gap-2">
                    <i class="pi pi-calendar" :style="`color: ${user.config.color_primary}` "/>
                    Agendar horário
                </h2>
            </div>
            <div class="py-2 px-0 md:py-4 md:px-2 flex flex-col md:flex-row gap-4 items-start">
                <div ref="easepickerRef" class="hidden"/>
                <div class="grid grid-cols-3 md:grid-cols-5 gap-8">
                    <button
                        type="button"
                        @click="setDatetime(slot.datetime)"
                        v-for="(slot, key) in slots"
                        :key="key"
                        class="py-3 px-4 text-sm border border-slate-200 rounded-md text-center  cursor-pointer"
                        :class="{ 'bg-primary-500 text-white hover:bg-primary-700': form.datetime === slot.datetime, 'hover:bg-gray-50/75': form.datetime !== slot.datetime }"
                    >
                        {{slot.time}}
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white p-4" ref="userRef">
            <div class="border-b p-2 flex justify-between items-center">
                <h2 class="text-md text-slate-500 flex items-center gap-2">
                    <i class="pi pi-user" :style="`color: ${user.config.color_primary}` "/>
                    Informe seus dados
                </h2>
            </div>
            <form class="px-2 py-4 flex flex-col gap-4">
                <div class="flex gap-2 items-end">
                    <div class="flex flex-col gap-2 flex-1">
                        <label for="phone" >Telefone</label>
                        <div class="flex gap-2 items-center">
                            <InputMask
                                id="phone"
                                type="text"
                                class="flex-1"
                                mask="(99) 9 9999-9999"
                                v-model="form.phone"
                                :disabled="phoneDisabled"
                                aria-labelledby="phone"
                                :invalid="!!form.errors.phone"
                                style="height: 40px"
                            />
                            <button
                                @click="handleSendCode"
                                type="button"
                                :disabled="loading || !form.phone || phoneDisabled"
                                class="text-sm h-10 transition-all text-slate-400 flex items-center gap-2 hover:text-primary-500 hover:border-primary-500 border py-2 rounded-md px-4"
                                :class="loading || !form.phone || phoneDisabled ? 'cursor-not-allowed' : 'cursor-pointer'"
                            >
                                <i class="pi pi-envelope" v-if="!loading"/>
                                <i class="pi pi-spinner animate-spin" v-else/>
                                <span>Enviar Código</span>
                            </button>
                        </div>
                        <small id="phone-help" class="text-red-600" v-if="form.errors.phone">{{form.errors.phone}}</small>
                    </div>
                </div>
                <div class="flex gap-2 items-end">
                    <div class="flex flex-col gap-2 flex-1">
                        <label for="phone" >Código de validação</label>
                        <div class="flex items-center gap-2">
                            <InputMask
                                id="code"
                                type="text"
                                mask="9999"
                                class="flex-1"
                                v-model="code"
                                aria-labelledby="code"
                                :disabled="loadingCode || !form.phone || codeValidation"
                                :invalid="!!codeErrors"
                                style="height: 40px"
                            />
                            <button
                                type="button"
                                :disabled="loadingCode || !code || !form.phone || codeValidation"
                                class="text-sm h-10 transition-all text-slate-400 flex items-center gap-2 hover:text-primary-500 hover:border-primary-500 border py-2 rounded-md px-4"
                                :class="loadingCode || !code || !form.phone || codeValidation ? 'cursor-not-allowed' : 'cursor-pointer'"
                                @click="handleValidationCode"
                            >
                                <i class="pi pi-check" v-if="!loadingCode"/>
                                <i class="pi pi-spinner animate-spin" v-else/>
                                <span>Válidar Código</span>
                            </button>
                        </div>

                        <small id="code-help" class="text-red-600" v-if="codeErrors">{{codeErrors}}</small>
                    </div>

                </div>

                <div class="flex flex-col gap-2">
                    <label for="name">Nome</label>
                    <InputText
                        id="name"
                        type="name"
                        v-model="form.name"
                        aria-describedby="name-help"
                        size="small"
                        :invalid="!!form.errors.name"
                        :disabled="!codeValidation"
                    />
                    <small id="name-help" class="text-red-600" v-if="form.errors.name">{{form.errors.name}}</small>
                </div>
                <div class="flex justify-end">
                    <Button label="Agendar" @click="handleSubmit" :loading="form.processing" type="button" icon="pi pi-check" :disabled="!codeValidation"
                            :style="`background: ${user.config.color_primary}; border: 1px solid ${user.config.color_primary}; color: ${user.config.color_secondary}`"
                    />
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
