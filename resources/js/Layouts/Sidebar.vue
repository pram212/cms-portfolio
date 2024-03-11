<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed, onMounted } from 'vue'

const menus = [
    {
        name: "Dashboard",
        url: "/dashboard",
        icon: '<i class="fas fa-industry w-5"></i>',
    },
    {
        name: "Manage Home",
        url: "/cms/home",
        icon: '<i class="fas fa-home w-5"></i>',
    },
    {
        name: "Manage Contact",
        url: "/cms/contact",
        icon: '<i class="fas fa-phone w-5 w-5"></i>',
    },
    {
        name: "Manage About",
        url: "/cms/about",
        icon: '<i class="fas fa-user w-5 w-5"></i>',
        submenu: [
            {
                name: "About me",
                url: "/cms/about/about-me",
                icon: '<i class="fas fa-quote-right w-5" aria-hidden="true"></i>',
            },
            {
                name: "Education",
                url: "/cms/about/educations",
                icon: '<i class="fas fa-graduation-cap w-5" aria-hidden="true"></i>',
            },
            {
                name: "Skills",
                url: "/cms/about/skills",
                icon: '<i class="fas fa-terminal w-5" aria-hidden="true"></i>',
            },
            {
                name: "Courses",
                url: "/cms/about/courses",
                icon: '<i class="fas fa-bookmark w-5" aria-hidden="true"></i>',
            },
            {
                name: "Experiences",
                url: "/cms/about/experiences",
                icon: '<i class="fas fa-briefcase w-5"></i>',
            },
        ]
    },
    {
        name: "Manage Portfolio",
        url: "/cms/portfolio",
        icon: '<i class="fas fa-tasks w-5"></i>',
    }
];


const isEmtySubmenu = (submenu) => {
    return _.size(submenu) > 0 ? true : false
}

</script>

<template>
    <aside class="bg-base-100 w-80 h-full">
        <ul class="menu p-4 w-80 capitalize font-semibold bg-base-100 min-h-screen text-base-content">
            <h2 class="menu-title">My CMS Portfolio</h2>
            <li v-for="(menu, i) in menus" :key="i">
                <!-- submenu 1 -->
                <details v-if="isEmtySubmenu(menu.submenu)" :open="$page.url.includes(menu.url)">
                    <summary>
                        <span v-html="menu.icon"></span> {{ menu.name }}
                    </summary>
                    <ul>
                        <li v-for="(submenu, j) in menu.submenu" :key="j">
                            <details v-if="isEmtySubmenu(submenu.submenu)" :open="$page.url.includes(submenu.url)">
                                <summary>
                                    <span v-html="submenu.icon"></span> {{ submenu.name }}
                                </summary>
                                <ul>
                                    <li v-for="(submenu2, j) in submenu.submenu" :key="j">
                                        <Link :href="submenu2.url" :class="{ active: $page.url.includes(submenu2.url) }">
                                            <span v-html="submenu2.icon"></span>{{ submenu2.name }}
                                        </Link>
                                    </li>
                                </ul>
                            </details>

                            <Link v-else :href="submenu.url" :class="{ active: $page.url.includes(submenu.url) }">
                                <span v-html="submenu.icon"></span>{{ submenu.name }}
                            </Link>
                        </li>
                    </ul>
                </details>
                <!-- submenu 1 end -->

                <Link v-else :href="menu.url" :class="{ active: $page.url.includes(menu.url) }">
                <span v-html="menu.icon"></span> {{ menu.name }}</Link>
            </li>
            <li class="my-5"></li>
        </ul>
    </aside>

    <!-- </aside> -->
</template>
