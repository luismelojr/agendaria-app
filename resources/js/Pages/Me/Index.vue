<script setup>
  import MeLayout from "@/UI/layouts/MeLayout.vue";

  defineOptions({
      layout: MeLayout
  })

  const props = defineProps({
      user: Object
  })

  const rating = ref(3)
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
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="md:col-span-3 bg-white p-4 rounded-md">
            <div class="border-b p-2">
                <h2 class="text-md text-slate-500 flex items-center gap-2">
                    <i class="pi pi-shopping-bag" :style="`color: ${user.config.color_primary}` "/>
                    Serviços
                </h2>
            </div>
            <div class="p-2">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                    <div v-for="service in user.services" :key="service.id" class="border p-4 rounded-md hover:border-primary-500">
                        <i class="pi pi-shopping-bag text-[20px]" :style="`color: ${user.config.color_primary}` "/>
                        <h3 class="mt-2 text-lg font-medium" :style="`color: ${user.config.color_primary}` ">{{service.name}}</h3>
                        <p class="mt-2 text-sm text-slate-400">{{service.description}}</p>
                        <span class="text-sm text-slate-400 mt-2 block">Duração: {{service.duration}} minutos</span>
                        <p class="mt-2 mb-10 text-xl text-slate-900">{{Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(service.price)}}</p>
                        <Link href="/" class="mt-4 px-4 py-2 w-full flex justify-center rounded-md" :style="`color: ${user.config.color_secondary}; background: ${user.config.color_primary}` ">Agendar</Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <div class="bg-white p-4 rounded-md">
                <div class="border-b p-2">
                    <h2 class="text-md text-slate-500 flex items-center gap-2">
                        <i class="pi pi-book" :style="`color: ${user.config.color_primary}` "/>
                        Bio
                    </h2>
                </div>
                <div class="p-2">
                    <p class="text-sm text-slate-400">{{user.config.bio}}</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-md">
                <div class="border-b p-2">
                    <h2 class="text-md text-slate-500 flex items-center gap-2">
                        <i class="pi pi-calendar" :style="`color: ${user.config.color_primary}` "/>
                        Horário
                    </h2>
                </div>
                <div class="p-2 space-y-2" v-if="user.schedules.length > 0">
                    <p v-if="!!user.schedules[0].monday_starts_at" class="text-sm text-slate-400">Segunda-Feira: {{user.schedules[0].monday_starts_at}} - {{user.schedules[0].monday_ends_at}}</p>
                    <p v-if="!!user.schedules[0].tuesday_starts_at" class="text-sm text-slate-400">Terça-Feira: {{user.schedules[0].tuesday_starts_at}} - {{user.schedules[0].tuesday_ends_at}}</p>
                    <p v-if="!!user.schedules[0].wednesday_starts_at" class="text-sm text-slate-400">Quarta-Feira: {{user.schedules[0].wednesday_starts_at}} - {{user.schedules[0].wednesday_ends_at}}</p>
                    <p v-if="!!user.schedules[0].thursday_starts_at" class="text-sm text-slate-400">Quinta-Feira: {{user.schedules[0].thursday_starts_at}} - {{user.schedules[0].thursday_ends_at}}</p>
                    <p v-if="!!user.schedules[0].friday_starts_at" class="text-sm text-slate-400">Sexta-Feira: {{user.schedules[0].friday_starts_at}} - {{user.schedules[0].friday_ends_at}}</p>
                    <p v-if="!!user.schedules[0].saturday_starts_at" class="text-sm text-slate-400">Sábado: {{user.schedules[0].saturday_starts_at}} - {{user.schedules[0].saturday_ends_at}}</p>
                    <p v-if="!!user.schedules[0].sunday_starts_at" class="text-sm text-slate-400">Domingo: {{user.schedules[0].sunday_starts_at}} - {{user.schedules[0].sunday_ends_at}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 bg-white p-4 rounded-md">
        aa
    </div>
</div>
</template>

<style scoped>

</style>
