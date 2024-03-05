<script setup>
import MainLayout from './Main.vue';
import { Head } from '@inertiajs/vue3';
</script>

<link rel="stylesheet" href="vue-typed-js/dist/vue-typed-js.css"/>

<template>
    <Head title="Home" />

    <MainLayout>
        <div class="">
            <h3 class="text-[50px] font-semibold uppercase mb-[20px] text-neutral-600">pramono</h3>
            <span class="line inline-block w-[70px] h-[3px] bg-[#333] mb-[15px]"></span>
            <h3 class="job text-[25px] mb-[25px] font-semibold text-gray-500 capitalize">fullstack developer</h3>
            
            <button
                class="bg-neutral-800 py-3 px-3 w-40 text-white border-4 border-neutral-800 hover:bg-white hover:text-neutral-800 font-semibold transition ease-in-out duration-200">
                Get in Touch
            </button>

        </div>
    </MainLayout>

</template>

