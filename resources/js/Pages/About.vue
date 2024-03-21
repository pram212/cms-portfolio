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
    experiences : Object,
})

const mappedEducations = props.educations.map(education => {
    return { date: education.start + " - " + education.end, institution: education.institution, description: education.title }
})

const mappedCourses = props.courses.map(course => {
    return { date:  moment(course.start).format("MMM YYYY") + " - " + moment(course.end).format("MMM YYYY"), institution: course.institution, description: course.description }
})

const mappedExperiences = props.experiences.map(experience => {
    return { 
        date:  moment(experience.start).format("MMM YYYY") + " - " + (experience.end ? moment(experience.end).format("MMM YYYY") : "Present"), 
        institution: experience.company, 
        description: experience.position 
    }
})

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
            <TimelineVue :list="mappedExperiences"></TimelineVue>
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
