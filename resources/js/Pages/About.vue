<script setup>
import { Head } from '@inertiajs/vue3';
import HeaderContent from '@/Components/HeaderContent.vue'
import MainLayout from './Main.vue';
import { onMounted, ref } from 'vue';
import TimelineVue from '@/Components/Timeline.vue';
import moment from 'moment';

const props = defineProps({
    educations : Object,
    courses : Object,
    skills : Object,
    services : Object,
    about : Object,
})

const mappedEducations = props.educations.map(education => {
    return { date: education.start + " - " + education.end, institution: education.institution, description: education.title }
})

const mappedCourses = props.courses.map(course => {
    return { date:  moment(course.start).format("MMM YYYY") + " - " + moment(course.end).format("MMM YYYY"), institution: course.institution, description: course.description }
})

const experiences = ref([
    { date: 'Jan 2020 - Oct 2021', institution : 'PT DesaTech Nusantara', description : 'Technical Writer' },
    { date: 'Feb 2022 - Aug 2023', institution : 'PT Mandala Dwipantara', description : 'Software Engineer' },
    { date: 'Sep 2022 - Present', institution : 'PT Melkhior Teknologi', description : 'Fullstack Developer' },
])

</script>

<template>
    <Head title="About" />

    <MainLayout>

        <section class="mb-10">
            <header-content :title="'about me'"></header-content>
            <p class=" mb-2">
                {{ about.bio }}
            </p>
        </section>

        <section class="mb-10">
            <header-content :title="'Education'"></header-content>
            <TimelineVue :list="mappedEducations"></TimelineVue>
        </section>

        <section class="mb-10">
            <header-content :title="'Course'"></header-content>
            <TimelineVue :list="mappedCourses"></TimelineVue>
        </section>

        <section class="mb-10">
            <header-content :title="'Experience'"></header-content>
            <TimelineVue :list="experiences"></TimelineVue>
        </section>

        <section class="mb-10">
            <header-content :title="'programming'"></header-content>
            <div class="w-full" v-for="(item, index) in skills" :key="index">
                <div class="flex items-center">
                    <label for="" class="uppercase w-[80%] font-semibold text-neutral-500" :class="[`w-${item.presentage}`]">{{item.name}}</label>
                    <span class=" text-neutral-500">{{ item.presentage }}</span>
                </div>
                <progress :value="item.presentage" max="100" class="h-[2px] text-neutral-700 w-full"></progress>
            </div>
        </section>

        <section class="mb-10">
            <header-content :title="'services'"></header-content>
            <ul class="space-y-2">
                <li class="capitalize" v-for="(item, index) in services" :key="index">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#94a3b8" viewBox="0 0 24 24" stroke-width="0"
                        stroke="currentColor" class="w-6 h-6 inline-block text-neutral-700 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                    </svg> {{ item.name }}
                </li>
            </ul>
        </section>
    </MainLayout>
    
</template>

<style>
    progress::-webkit-progress-bar {
        @apply bg-neutral-200
    }

    progress::-webkit-progress-value {
        @apply bg-neutral-400
    }
</style>
