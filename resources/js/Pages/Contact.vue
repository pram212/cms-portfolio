<script setup>
import MainLayout from "./Main.vue";
import { Head, useForm } from "@inertiajs/vue3";
import HeaderContentVue from "@/Components/HeaderContent.vue";
import { ref } from "vue";
const props = defineProps({
    contact: Object,
})

const form = useForm({
    name: null,
    email: null,
    message: null,
})

const notification = ref(false)

const sendMessage = () => {
    form.post(route('send-message'), {
        preserveState: true,
        onSuccess: () => notification.value = true
    })
}
</script>

<template>

    <Head title="Contact" />

    <MainLayout>
        <HeaderContentVue :title="'contact'" />

        <section class="mb-10">
            <div class="md:grid md:grid-cols-3 gap-2 text-neutral-500">
                <div class="w-full border py-10 border-1 border-neutral-300 flex flex-col items-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <div>{{ contact.address }}</div>
                </div>
                <div class="w-full border py-10 border-1 border-neutral-300 flex flex-col items-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>

                    <div>{{ contact.email }}</div>
                </div>
                <div class="w-full border py-10 border-1 border-neutral-300 flex flex-col items-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>

                    <div>{{ contact.phone }}</div>
                </div>
            </div>
        </section>

        <section class="mb-10">
            <div role="alert" class="alert mb-2" v-if="notification">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-info shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Terimakasih, pesan berhasil dikirim</span>
                <div>
                    <button type="button" @click="notification=false" class="btn btn-sm btn-primary">ok</button>
                </div>
            </div>

            <form action="" @submit.prevent="sendMessage">
                <small class="text-error font-semibold" v-if="form.errors.name">{{ form.errors.name }}</small>
                <input type="text" v-model="form.name" placeholder="Your Name"
                    class="w-full px-2 bg-transparent border border-neutral-300 mb-3 focus:border-neutral-300"
                    autofocus>
                <small class="text-error font-semibold" v-if="form.errors.email">{{ form.errors.email }}</small>
                <input type="email" v-model="form.email" placeholder="Your Email"
                    class="w-full px-2 bg-transparent border border-neutral-300 mb-3">
                <small class="text-error font-semibold" v-if="form.errors.message">{{ form.errors.message }}</small>
                <textarea v-model="form.message" rows="5" placeholder="Your Message"
                    class="w-full px-2 bg-transparent border border-neutral-300 mb-3"></textarea>
                <button type="submit"
                    class="bg-black text-white px-10 py-2 border hover:bg-transparent hover:text-neutral-400 hover:border hover:border-neutral-400 capitalize font-poppins">send</button>
            </form>
        </section>

    </MainLayout>
</template>
