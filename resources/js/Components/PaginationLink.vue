<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links : Object
})

</script>

<template>
    <div class="btn-group">
        <Link class="btn btn-ghost btn-sm" v-for="(link, p) in links" :key="p"
            :class="{ 'btn-active': link.active }" :href="link.url" preserve-state preserve-scroll>
        <span v-if="link.label.includes('Previous')">«</span>
        <span v-else-if="link.label.includes('Next')">»</span>
        <span v-else>{{ link.label }}</span>
        </Link>
    </div>
</template>
