<template>
    <ul>
        <li class="relative flex gap-5 items-baseline" v-for="(item, i) in list" :key="i">
            <div class="before:absolute before:inset-0 before:border-gray-500 before:h-full before:w-[1px] before:bg-neutral-400">
                <div
                    class="h-6 w-6 text-center border-2 border-neutral-300 bg-slate-100 rounded-full absolute -left-3 top-3">
                </div>
            </div>
            <div class="flex gap-3">
                <span class=" bg-neutral-200 text-center px-3 my-auto py-1 rounded-full text-neutral-500 w-[180px]">{{ item.date }}</span>
                <div class="flex-1">
                    <span class="text-neutral-700 font-bold block text-wrap">{{ item.institution }}</span>
                    <span class="text-neutral-500 capitalize text-semibold text-sm">{{ item.description }}</span>
                </div>
            </div>
        </li>
    </ul>
</template>

<script setup>
const props = defineProps({ list: Object })
</script>