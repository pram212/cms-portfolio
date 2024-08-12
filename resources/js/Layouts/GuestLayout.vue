<script setup>
import { Link } from "@inertiajs/vue3";
import { themeChange } from "theme-change";
import { onMounted } from "vue";
onMounted(() => {
  themeChange(false);
});
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover" style="background-image: url('/img/bg-login.jpg');">

    <div class="w-full sm:max-w-md mt-6 px-6 pb-6 bg-base-300 shadow-md overflow-hidden sm:rounded-lg">
      <Link href="/" class="w-full flex justify-center">
        <div class="avatar">
          <div class="w-40 rounded-full">
            <img src="/img/logo.svg" />
          </div>
        </div>
      </Link>

      <slot />

    </div>
  </div>
</template>
