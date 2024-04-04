<script setup>
    import Toast from 'primevue/toast';
    import {usePage} from "@inertiajs/vue3";
    import {computed, onMounted, watch} from "vue";
    import { useToast } from 'primevue/usetoast';

    const toast = useToast()
    const page = usePage();
    const toasts = computed(() => page.props.auth.toasts)

    const renderToasts = (toastsSource) => {
        toastsSource.forEach(item => {
            const title = item.type === 'success' ? 'Sucesso' : 'Erro'
            toast.add({severity: item.type, summary: title, detail: item.text, life: item.duration})
        })
    }

    onMounted(() => renderToasts(toasts.value))

    watch(toasts, (newToasts) => {
        renderToasts(newToasts)
    })
</script>
<template>
    <Toast position="bottom-right"/>
</template>
