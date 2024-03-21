<script setup>
import MainLayout from './Main.vue'
import { Head } from '@inertiajs/vue3'
import HeaderContentVue from '@/Components/HeaderContent.vue'
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import moment from 'moment'

const props = defineProps({
    portfolio : Object,
})

</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}

.carousel__viewport {
  perspective: 2000px;
}

.carousel__track {
  transform-style: preserve-3d;
}

.carousel__slide--sliding {
  transition: 0.5s;
}

.carousel__slide {
  opacity: 0.9;
  transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--active ~ .carousel__slide {
  transform: rotateY(20deg) scale(0.9);
}

.carousel__slide--prev {
  opacity: 1;
  transform: rotateY(-10deg) scale(0.95);
}

.carousel__slide--next {
  opacity: 1;
  transform: rotateY(10deg) scale(0.95);
}

.carousel__slide--active {
  opacity: 1;
  transform: rotateY(0) scale(1.1);
}
</style>

<template>
    <Head title="Portfolio" />

    <MainLayout>
        <!-- preview section -->
        <section class="mb-10">
            <HeaderContentVue :title="portfolio.project_title"/>
            <span class="text-neutral-400 text-sm">
                {{ moment(portfolio.start).format('MMM YYYY') }} - 
                {{ moment(portfolio.end).format('MMM YYYY') }}
            </span>
            <Carousel :autoplay="2500" :itemsToShow="1.5" :wrap-around="true" class="mt-10">
                <Slide v-for="(item, index) in JSON.parse(portfolio.images)" :key="index">
                    <div class="flex justify-center items-center carousel__item h-60 w-full bg-cover bg-no-repeat" :style="{ 'background-image' : `url(${item})` }">
                    </div>
                </Slide>

                <template #addons>
                    <Navigation />
                    <Pagination/>
                </template>

            </Carousel>

        </section>
        <!-- preview section end -->
        
        <!-- summary section start -->
        <section class="mb-10">
            <HeaderContentVue :title="'summary'"/>
            <p class="whitespace-pre-line text-justify">{{ portfolio.description }}</p>
        </section>
        <!-- summary section end -->

        <!-- technology section start -->
        <section class="mb-10">
            <HeaderContentVue :title="'Technology'"/>
            <ul class="space-y-2">
                <li v-for="(item, index) in JSON.parse(portfolio.technologies)" :key="index" class="uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#94a3b8" viewBox="0 0 24 24" stroke-width="0"
                        stroke="currentColor" class="w-6 h-6 inline-block text-neutral-700 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                    </svg> {{ item }}
                </li>
            </ul>
        </section>
        <!-- technology section end -->
        
        <!-- section features start -->
        <section class="mb-10">
            <HeaderContentVue :title="'Modules / Features'"/>
            <ul>
                <li v-for="(item, index) in JSON.parse(portfolio.modules)" :key="index" class="capitalize">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#94a3b8" viewBox="0 0 24 24" stroke-width="0"
                        stroke="currentColor" class="w-6 h-6 inline-block text-neutral-700 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                    </svg> {{ item }}
                </li>
            </ul>
        </section>
        <!-- section features end -->

        <!-- demo section start -->
        <section class="mb-10" v-if="portfolio.demo">
            <HeaderContentVue :title="'Demo'"/>
            <table class="text-left w-full">
                <tr>
                    <th>URL</th>
                    <td>: {{ JSON.parse(portfolio.demo).url ?? "Not Available" }}</td>
                </tr>
                <tr>
                    <th>Other Info</th>
                    <td>: <span class="tracking-wider"> {{ JSON.parse(portfolio.demo).info ?? "Not Available" }}</span>
                    </td>
                </tr>
            </table>
        </section>
        <!-- demo section end -->
       
    </MainLayout>

</template>
