<script setup>
import { onMounted } from "vue";
import { themeChange } from "theme-change";
import { Link, usePage } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import Sidebar from "@/Layouts/Sidebar.vue";

const notificationType = usePage().props.flash.type;
const notificationMessage = usePage().props.flash.message;

onMounted(() => {
    themeChange(false);

    if (usePage().props.flash.type) {
        if (notificationType == 'success') {
            const template = `<div class="flex p-0"><i class="fas fa-check-circle mr-2"></i> ${notificationMessage}</div>`
            toaster.success(template);
        } else {
            const template = `<div class="flex p-0"><i class="fas fa-exclamation mr-2"></i> ${notificationMessage}</div>`
            toaster.error(template);
        }
    }

    setTimeout(toaster.clear(), 3000);

});
</script>

<template>
    <div class="drawer">
        <div class="drawer-content max-h-full overflow-x-scroll">
            <!-- Navbar -->
            <Navbar></Navbar>
            <!-- Navbar End -->

            <!-- PAGE CONTENT -->
            <div class="min-h-screen bg-base-300 ">
                <!-- Page Heading -->
                <header class="bg-base-200 py-2 px-6 shadow-lg flex justify-between" v-if="$slots.breadcrumbs">
                    <div class="text-sm font-semibold breadcrumbs text-secondary">
                        <slot name="breadcrumbs"></slot>
                    </div>
                    <Link :href="route('dashboard')" class="btn btn-secondary btn-ghost">Back to Home</Link>
                </header>
                <!-- Page content here -->
                <main>
                    <div class="py-12">
                        <div class="max-w-7xl sm:px-6 lg:px-8">
                            <div class="bg-gradient-to-b from-base-100 overflow-hidden shadow-sm sm:rounded-lg p-8">
                                <slot />
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- PAGE CONTENT END -->
        </div>
    </div>
</template>
