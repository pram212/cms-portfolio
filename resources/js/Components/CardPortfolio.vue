<template>
    <div class="w-full max-h-sm animated bounceInUp bg-gray-400" @mouseenter="showCaption=true" @mouseleave="showCaption=false">
        <div class="grayscale bg-no-repeat bg-cover h-80 cursor-pointer min-h-sm relative"
            :style="{'background-image': `url(${bg_image})`}">
            <div class="absolute w-[70%] inset-x-[15%] top-[10%] bg-white animated overflow-x-hidden" :class="[ !showCaption ? 'flipOutY' : 'flipInY'] ">
                <h1 class="text-center text-xs font-semibold h-full text-neutral-600 py-2 px-6 shadow-lg">{{ caption }}
                </h1>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
const showCaption = ref(false)

const porps = defineProps({
    bg_image: String,
    caption: String,
});
</script>