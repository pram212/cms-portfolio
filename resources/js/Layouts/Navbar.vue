<script setup>
import HamburgerVue from "@/Components/Hamburger.vue";
import ThemeControlVue from "@/Components/ThemeControl.vue";
import { Link } from "@inertiajs/vue3";

</script>

<template>
    <div class="navbar py-0 shadow-md bg-base-100">
        <div class="flex-1">
            <h4 class="font-semibold ml-8 capitalize">
                portfolio content management system
            </h4>
        </div>
        <div class="flex-none gap-2">
            <ThemeControlVue></ThemeControlVue>

            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost avatar">
                    {{ $page.props.auth.user.name }}
                </label>
                <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <Link :href="route('logout')" method="post" as="button">Logout</Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
