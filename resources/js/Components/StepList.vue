<script setup>
const props = defineProps({ list: Object })
</script>

<template>
    <table class="w-full">
        <tr class="border-l-2" v-for="(item, i) in list" :key="i">
            <td class="relative">
                <div
                    class="h-6 w-6 text-center border-2 border-neutral-300 bg-slate-100 rounded-full absolute -left-3 top-3">
                </div>
            </td>
            <td>
                <div class="flex space-x-4">
                    <span class="ml-5 bg-neutral-200 text-center px-3 my-auto py-1 rounded-full text-neutral-500 w-[180px]">{{ item.date }}</span>
                    <div>
                        <span class="text-neutral-700 font-bold block text-wrap">{{ item.institution }}</span>
                        <span class="text-neutral-500 capitalize text-semibold">{{ item.description }}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</template>