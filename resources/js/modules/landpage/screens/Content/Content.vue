<script setup>
import Logo from '@/modules/landpage/components/Logo/Logo.vue'
</script>

<template>
    <section class="mt-20 space-y-20 container-new">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full">
            <div class="w-full">
                <img src="https://tailwindui.com/img/component-images/dark-project-app-screenshot.png" alt="Product screenshot" class="w-full rounded-xl">
            </div>
            <div class="flex flex-col gap-2">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Cadastre seus serviços</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Facilite a vida dos seus clientes</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">Podendo cadastrar seus serviços, você facilita a vida dos seus clientes e ainda aumenta a eficiência do seu negócio.</p>
            </div>
        </div>
    </section>
    <section class="mt-20 container-new">
        <div class="flex flex-col justify-center items-center">
            <h2 class="text-base font-semibold leading-7 text-indigo-600">Benefícios</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Aumente a eficiência do seu negócio</p>
            <p class="mt-2 text-lg leading-8 text-gray-600">Benefícios que você terá ao utilizar nosso sistema de agendamento:</p>
        </div>
        <div class="mt-10 md:mt-20 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <div class="flex gap-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <h4 class="leading-7 text-gray-800 font-bold">Cadastro de serviços</h4>
                    <p class="text-base leading-7 text-gray-600">Cadastre seus serviços com nome, preço e tempo de duração e caso necessite coloque um prazo extra a mais.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <h4 class="leading-7 text-gray-800 font-bold">Cadastro de horários</h4>
                    <p class="text-base leading-7 text-gray-600">Cadastre seus horários de atendimento disponíveis para cada dia da semana, informando o horário de início e fim.</p>
                </div>
            </div>
        </div>
        <div class="mt-10 md:mt-20 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <div class="flex gap-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <h4 class="leading-7 text-gray-800 font-bold">Personalização da tela de agendamento</h4>
                    <p class="text-base leading-7 text-gray-600">Personalize a tela de agendamento com as cores e logo da sua empresa, deixando-a com a sua cara.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <h4 class="leading-7 text-gray-800 font-bold">Notificações por WhatsApp</h4>
                    <p class="text-base leading-7 text-gray-600">Envie notificações de agendamento e lembretes de atendimento para seus clientes via WhatsApp.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray-900 mt-20 py-24 sm:py-32">
        <div class="container-new">
            <div class="flex flex-col justify-center items-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-400">Planos</h2>
                <p class="mt-2 text-4xl font-bold tracking-tight text-white sm:text-5xl">Planos disponíveis</p>
                <p class="mt-2 text-center text-lg leading-8 text-gray-300">Escolha o plano que mais se encaixa no seu negócio</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-20">
                <div class="rounded-3xl p-8 xl:p-10 ring-1 ring-white/10">
                    <div class="flex items-center justify-between gap-x-4">
                        <h3 id="tier-freelancer" class="text-lg font-semibold leading-8 text-white">Gratuito</h3>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-gray-300">Plano ideal para quem está começando e quer testar o sistema.</p>
                    <p class="mt-6 flex items-baseline gap-x-1">
                        <!-- Price, update based on frequency toggle state -->
                        <span class="text-4xl font-bold tracking-tight text-white">R$ 0</span>
                        <!-- Payment frequency, update based on frequency toggle state -->
                        <span class="text-sm font-semibold leading-6 text-gray-300">/mês</span>
                    </p>
                    <a href="#" aria-describedby="tier-freelancer" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-white/10 text-white hover:bg-white/20 focus-visible:outline-white">Contratar plano</a>
                    <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300 xl:mt-10">
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Agendamento ilimitado
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Cadastro de serviços
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Cadastro de horários
                        </li>
                    </ul>
                </div>
                <div class="rounded-3xl p-8 xl:p-10 bg-white/5 ring-2 ring-indigo-500">
                    <div class="flex items-center justify-between gap-x-4">
                        <h3 id="tier-startup" class="text-lg font-semibold leading-8 text-white">Premium</h3>
                        <p class="rounded-full bg-indigo-500 px-2.5 py-1 text-xs font-semibold leading-5 text-white">Mais popular</p>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-gray-300">Plano ideal para quem já tem um negócio e quer aumentar a eficiência.</p>
                    <p class="mt-6 flex items-baseline gap-x-1">
                        <!-- Price, update based on frequency toggle state -->
                        <span class="text-4xl font-bold tracking-tight text-white">R$ 59,90</span>
                        <!-- Payment frequency, update based on frequency toggle state -->
                        <span class="text-sm font-semibold leading-6 text-gray-300">/mês</span>
                    </p>
                    <a href="#" aria-describedby="tier-startup" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-500 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline-indigo-500">Contratar plano</a>
                    <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300 xl:mt-10">
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Todos os benefícios do plano gratuito
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Personalização da tela de agendamento
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Notificações por e-mail e WhatsApp
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Avaliação de atendimentos
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Relatórios de atendimentos
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Suporte 24/7 por e-mail e WhatsApp
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <footer class="py-10 flex items-center flex-col gap-2 justify-center">
        <Logo class="w-10 h-10"/>
        <span class="text-sm text-gray-600">
            © {{new Date().getFullYear()}} Todos os direitos reservados
        </span>
        <span class="text-sm text-gray-600">Feito com ❤️ por <a href="" target="_blank" class="hover:underline hover:text-indigo-600">Luis Henrique</a></span>
    </footer>
</template>

<style scoped>

</style>
<script setup>
</script>
