<script setup>
  import MeLayout from "@/UI/layouts/MeLayout.vue";

  defineOptions({
      layout: MeLayout
  })

  const props = defineProps({
      user: Object
  })

  const rating = ref(3)

  function obterEndereco(cep) {
      // Endpoint da API ViaCEP
      let url = `https://viacep.com.br/ws/${cep}/json/`;

      // Requisição AJAX para obter os dados do endereço
      fetch(url)
          .then(response => response.json())
          .then(data => {
              // Verifica se o endereço foi encontrado
              if (!data.erro) {
                  // Constrói o link para o Google Maps com base nas informações do endereço
                  let endereco = `${data.logradouro}, ${data.bairro}, ${data.localidade}, ${data.uf}`;
                  let enderecoCodificado = encodeURIComponent(endereco).replace(/%20/g, '+');
                  let linkGoogleMaps = `https://www.google.com/maps?q=${enderecoCodificado}`;

                  // Abre o link no navegador
                  window.open(linkGoogleMaps, '_blank');
              } else {
                  console.log('CEP não encontrado.');
              }
          })
          .catch(error => console.error('Ocorreu um erro:', error));
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
    <div class="mt-8 w-full">
        <div class="md:col-span-3 bg-white p-4 rounded-md">
            <div class="border-b p-2">
                <h2 class="text-md text-slate-500 flex items-center gap-2">
                    <i class="pi pi-shopping-bag" :style="`color: ${user.config.color_primary}` "/>
                    Serviços
                </h2>
            </div>
            <div class="p-2">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    <div v-for="service in user.services" :key="service.id" class="border flex justify-between flex-col p-4 rounded-md hover:border-primary-500">
                        <div>
                            <i class="pi pi-shopping-bag text-[20px]" :style="`color: ${user.config.color_primary}` "/>
                            <h3 class="block text-gray-700 leading-snug font-semibold text-lg mt-3" >{{service.name}}</h3>
                            <p class="text-dark-blue opacity-75 text-sm mt-4 line-clamp-2">{{service.description}}</p>
                            <div class="flex items-center gap-4 mt-4">
                                <div class="space-x-1">
                                    <i class="pi pi-clock text-[12px] text-slate-400" />
                                    <span class="text-slate-400 text-[12px]">{{service.duration}} minutos</span>
                                </div>
                                <div class="space-x-1">
                                    <i class="pi pi-clock text-[12px] text-slate-400" />
                                    <span class="text-slate-400 text-[12px]">{{service.duration}} minutos</span>
                                </div>
                            </div>
                            <p class="mt-2 mb-10 text-xl text-slate-900">{{Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(service.price)}}</p>
                        </div>
                        <Link :href="route('me.home.service', {'email': user.email, 'service': service.id})" class="mt-4 px-4 py-2 w-full flex justify-center rounded-md" :style="`color: ${user.config.color_secondary}; background: ${user.config.color_primary}` ">Agendar</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
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
        <div class="bg-white p-4 rounded-md flex flex-col">
            <div class="border-b p-2">
                <h2 class="text-md text-slate-500 flex items-center gap-2">
                    <i class="pi pi-compass" :style="`color: ${user.config.color_primary}` "/>
                    Endereço
                </h2>
            </div>
            <div class="p-2 flex flex-col justify-between flex-1 gap-4">
                <p class="text-sm text-slate-400">Rua J-42 Qd 08 Lt 29 Mansoes Paraiso</p>
                <button @click="obterEndereco('74952250')" class="w-full flex justify-center py-2 rounded-md" :style="`color: ${user.config.color_secondary}; background: ${user.config.color_primary}`">Ver no mapa</button>
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
    <div class="mt-8 bg-white p-4 rounded-md">
        <div class="border-b p-2">
            <h2 class="text-md text-slate-500 flex items-center gap-2">
                <i class="pi pi-shopping-bag" :style="`color: ${user.config.color_primary}` "/>
                Galeria de fotos
            </h2>
        </div>
        <div class="p-2 grid grid-cols-1 md:grid-cols-4 gap-2">
            <Image v-for="item in 10" src="https://primefaces.org/cdn/primevue/images/galleria/galleria10.jpg" alt="Image" preview class="rounded-md" />
        </div>
    </div>
</div>
</template>


