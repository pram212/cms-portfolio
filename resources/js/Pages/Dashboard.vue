<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        
        <div class="grid grid-cols-3">
           <div class="border border-base-200 shadow-md h-24 rounded-md w-[250px] space-x-3 flex bg-gradient-to-r from-indigo-400">
                <div class="w-24 rounded-l-md">
                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                </div>
                <div class="my-auto">
                    <h1 class="font-semibold text-1xl">My Skills</h1>
                    <span class="text-base-100 font-semibold badge badge-success">10</span>
                </div>
           </div>
        </div>
    </AuthenticatedLayout>
</template>
