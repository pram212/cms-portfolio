<script setup>
import MainLayout from './Main.vue';
import { Head, Link } from '@inertiajs/vue3';
import HeaderContentVue from '@/Components/HeaderContent.vue';
import CardPortfolio from '@/Components/CardPortfolio.vue';
import { onMounted } from 'vue';

const props = defineProps({
    portfolios : Object,
})

const portfolioMapped = props.portfolios.map(item => {
    return { id: item.id, caption : item.project_title, path: JSON.parse(item.images) }
})

</script>

<template>
    <Head title="Portfolio" />

    <MainLayout>
        <div>
            <HeaderContentVue :title="'portfolio'" />
            <div class="md:grid grid-cols-1 md:grid-cols-2 gap-5 max-h-fit">
                <Link :href="'portfolio-detail/' + item.id" v-for="(item, index) in portfolioMapped" :key="index">
                    <CardPortfolio :caption="item.caption" :bg_image="item.path[1]" />
                </Link>
            </div>
        </div>
    </MainLayout>

</template>
