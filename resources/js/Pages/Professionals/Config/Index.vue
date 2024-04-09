<script setup>
import DashboardLayout from "@/UI/layouts/DashboardLayout.vue";
import BoxTitle from "@/UI/components/box-title/BoxTitle.vue";
import CardCustom from "@/UI/components/card/CardCustom.vue";
import {useForm} from "@inertiajs/vue3";

defineOptions({
    layout: DashboardLayout
})

const props = defineProps({
    config: Object
})

const menuItems = ref([
    {
        name: 'Personalizar Tela de Agendamento',
        url: null,
        active: true,
    },
])

const imagePreview = ref(props.config.banner_image)

const form = useForm({
    bio: props.config.bio ?? '',
    color_primary: props.config.color_primary ?? '',
    color_secondary: props.config.color_secondary ?? '',
})

const formBanner = useForm({
    banner_image: props.config.banner_image ?? null,
})

const handleImage = (event) => {
    if (event.target.files[0].size > 2097152) {
        formBanner.errors.banner_image = 'A imagem não pode ser maior que 2MB'
        return
    }
    formBanner.errors.banner_image = null
    formBanner.banner_image = event.target.files[0]
    const reader = new FileReader()
    reader.onload = (e) => {
        imagePreview.value = e.target.result
    }
    reader.readAsDataURL(event.target.files[0])
}

const handleSubmit = () => {
    form.put(route('config.update'))
}

const handleSubmitBanner = () => {
    formBanner.post(route('config.update.banner'))
}

const formattedColor = (color) => {
    return color[0] === '#' ? color : `#${color}`
}
</script>

<template>
    <Head title="Personalizar Tela de Agendamento" />
    <div class="space-y-10 overflow-y-auto">
        <BoxTitle title="Personalizar Tela de Agendamento" :menuItems="menuItems" />
        <CardCustom title="Tela de Agendamento" subtitle="Personalize a tela de agendamento de acordo com as suas preferências">
            <form class="space-y-4" @submit.prevent="handleSubmit">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="color_primary">Cor Primária</label>
                        <div class="flex gap-2 items-center">
                            <ColorPicker v-model="form.color_primary" />
                            <InputText id="color_primary" type="text" class="flex-1" v-model="form.color_primary" aria-describedby="color_primary-help" :invalid="!!form.errors.color_primary"/>
                        </div>
                        <small id="color_primary-help" class="text-red-600" v-if="form.errors.color_primary">{{form.errors.color_primary}}</small>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="color_secondary">Cor Secundária</label>
                        <div class="flex gap-2 items-center">
                            <ColorPicker v-model="form.color_secondary" />
                            <InputText id="color_secondary" type="text" class="flex-1" v-model="form.color_secondary" aria-describedby="color_secondary-help" :invalid="!!form.errors.color_secondary"/>
                        </div>
                        <small id="color_secondary-help" class="text-red-600" v-if="form.errors.color_secondary">{{form.errors.color_secondary}}</small>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span>Preview das cores</span>
                        <button class="py-2 px-4 rounded-md flex items-center justify-center" :style="`background: ${formattedColor(form.color_primary)}; color: ${formattedColor(form.color_secondary)}`">Botão</button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="bio">Biografia</label>
                    <InputText id="bio" type="text" v-model="form.bio" aria-describedby="bio-help" :invalid="!!form.errors.bio"/>
                    <small id="bio-help" class="text-red-600" v-if="form.errors.bio">{{form.errors.bio}}</small>
                </div>
                <div class="mt-4 flex justify-end">
                    <Button label="Salvar" size="small" variant="primary" :loading="form.processing" icon="pi pi-save" type="submit"/>
                </div>
            </form>
        </CardCustom>
        <CardCustom title="Banner" subtitle="Personalize o banner da tela de agendamento">
            <form class="space-y-4" @submit.prevent="handleSubmitBanner" enctype="multipart/form-data">
                <div class="flex flex-col gap-2">
                    <label for="banner_image">Imagem de Banner</label>
                    <InputText
                        id="banner_image"
                        type="file"
                        @input="handleImage" aria-describedby="banner_image-help"
                        :invalid="!!formBanner.errors.banner_image"
                    />
                    <small id="banner_image-help" class="text-red-600" v-if="formBanner.errors.banner_image">{{formBanner.errors.banner_image}}</small>
                </div>
                <div class="w-full" v-if="formBanner.banner_image">
                    <Image :src="imagePreview" alt="Banner" class="w-full object-cover" preview />
                </div>
                <div class="mt-4 flex justify-end">
                    <Button label="Salvar banner" size="small" variant="primary" :loading="formBanner.processing" icon="pi pi-save" type="submit"/>
                </div>
            </form>
        </CardCustom>
    </div>
</template>

<style scoped>

</style>
