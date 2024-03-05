<template>
    <div class="flex justify-between items-center space-x-3 mb-5 w-[90%]">
        <div class="tracking-[8px] uppercase font-extrabold">{{ title ?? 'No title' }}</div>
        <div class="divider"></div>
    </div>
</template>

<script setup>
const props = defineProps({
    title : String
})
</script>