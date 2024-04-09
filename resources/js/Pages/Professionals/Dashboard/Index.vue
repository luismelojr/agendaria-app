<script setup>
    import DashboardLayout from "@/UI/layouts/DashboardLayout.vue";
    import Stat from "@/UI/components/stats/Stat.vue";

    defineOptions({
        layout: DashboardLayout
    })

    defineProps({
        serviceCount: Number,
        appointmentTotalCount: Number,
        appointmentTodayCount: Number
    })
</script>

<template>
    <Head title="Panel de Controle" />
    <div class="space-y-10 overflow-y-auto">
        <div class="space-y-2">
            <h1 class="text-gray-900 font-bold text-2xl">Dashboard</h1>
            <p class="text-sm text-gray-600">Bem-vindo ao seu painel de controle.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Stat title="Total de Agendamentos Hoje" :value="appointmentTodayCount" icon="pi pi-calendar" :href="route('dashboard')"/>
            <Stat title="Total de Serviços" :value="serviceCount" icon="pi pi-shopping-bag" :href="route('services.index')"/>
            <Stat title="Total de Agendamentos Realizados" :value="appointmentTotalCount" icon="pi pi-calendar" :href="route('dashboard')"/>
        </div>
    </div>
</template>

<style scoped>

</style>
