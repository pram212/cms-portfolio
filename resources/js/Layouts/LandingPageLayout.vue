<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue'

const openMobileMenu = ref(false)

</script>

<template>
    <div class="container min-h-[100vh] max-w-full md:max-w-6xl clear-both float-left relative font-poppins">
        <!-- navbar start -->
        <nav
            class="fixed top-0 left-0 right-0 h-[70px] bg-white z-[20] leading-[70px] flex items-center justify-between py-0 px-6 md:px-[70px] middle:hidden">
            <div class="text-3xl font-semibold tracking-[10px] uppercase">pramono</div>
            <div class="menu relative hidden md:flex">
                <ul class="flex">
                    <li class="">
                        <Link href="/home" :class="{ 'bg-neutral-800 text-white': $page.url == '/home' }"
                            class="font-medium max-h-fit py-0 px-[30px] inline-block hover:bg-neutral-800 hover:text-white transition-all duration-300 ease-in-out capitalize">
                        home
                        </Link>
                    </li>
                    <li class="">
                        <Link href="/about" :class="{ 'bg-neutral-800 text-white': $page.url == '/about' }"
                            class="font-poppins font-medium pu-0 px-[30px] inline-block hover:bg-neutral-800 hover:text-white transition-all duration-300 capitalize">
                        about
                        </Link>
                    </li>
                    <li class="">
                        <Link href="portfolio" :class="{ 'bg-neutral-800 text-white': $page.url == '/portfolio' }"
                            class="font-poppins font-medium pu-0 px-[30px] inline-block hover:bg-neutral-800 hover:text-white transition-all duration-300 capitalize">
                        portfolios
                        </Link>
                    </li>
                    <li class="">
                        <Link href="contact" :class="{ 'bg-neutral-800 text-white': $page.url == '/contact' }"
                            class="font-poppins font-medium pu-0 px-[30px] inline-block hover:bg-neutral-800 hover:text-white transition-all duration-300 capitalize">
                        contact
                        </Link>
                    </li>
                </ul>
                <span class="ccc absolute block top-[15px] bg-[#333] z-[-1] transition-all duration-500 "></span>
            </div>
            <div class="flex items-center md:hidden">
                <button v-if="!openMobileMenu" class=" md:hidden" type="button" @click="openMobileMenu = !openMobileMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
                <button v-if="openMobileMenu" type="button" class="md:hidden" @click="openMobileMenu = !openMobileMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </nav>
        <!-- navbar end -->

        <!-- mobile sidebar -->
        <nav v-show="openMobileMenu" id="mobile-menu"
            class="z-[15] md:hidden animated text-sm fixed bg-white shadow-lg top-0 bottom-0 left-1/2 right-0 py-[70px] pl-[30px] font-extrabold flex items-center">
            <ul class="space-y-6">
                <li>
                    <div class="w-14 h-14 grayscale bg-cover rounded-sm shadow-md"
                        style="background-image: url('img/foto.jpg');">
                    </div>
                </li>
                <li class="uppercase font-poppins max-w-fit" :class="{ 'underline underline-offset-8': $page.url == '/home' }">
                    <a href="/home">Home</a>
                </li>
                <li class="uppercase font-poppins max-w-fit" :class="{ 'underline underline-offset-8': $page.url == '/about' }">
                    <a href="/about">about</a>
                </li>
                <li class="uppercase font-poppins max-w-fit"
                    :class="{ 'underline underline-offset-8': $page.url == '/portfolio' }">
                    <a href="/portfolios">portfolios</a>
                </li>
                <li class="uppercase font-poppins max-w-fit"
                    :class="{ 'underline underline-offset-8': $page.url == '/contact' }">
                    <a href="/contact">contact</a>
                </li>
                <li class="flex justify-start space-x-3">
                    <a href="https://www.linkedin.com/in/pramono-82a0721b9/" target="_blank">
                        <svg role="img" fill="gray" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                            <title>LinkedIn</title>
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                    </a>
                    <a href="https://gitlab.com/pramono6236" target="_blank">
                        <svg role="img" viewBox="0 0 24 24" fill="gray" width="20" xmlns="http://www.w3.org/2000/svg">
                            <title>GitLab</title>
                            <path
                                d="m23.6004 9.5927-.0337-.0862L20.3.9814a.851.851 0 0 0-.3362-.405.8748.8748 0 0 0-.9997.0539.8748.8748 0 0 0-.29.4399l-2.2055 6.748H7.5375l-2.2057-6.748a.8573.8573 0 0 0-.29-.4412.8748.8748 0 0 0-.9997-.0537.8585.8585 0 0 0-.3362.4049L.4332 9.5015l-.0325.0862a6.0657 6.0657 0 0 0 2.0119 7.0105l.0113.0087.03.0213 4.976 3.7264 2.462 1.8633 1.4995 1.1321a1.0085 1.0085 0 0 0 1.2197 0l1.4995-1.1321 2.4619-1.8633 5.006-3.7489.0125-.01a6.0682 6.0682 0 0 0 2.0094-7.003z" />
                        </svg>
                    </a>
                    <a href="https://github.com/pram212" target="_blank">
                        <svg role="img" viewBox="0 0 24 24" fill="gray" width="20" xmlns="http://www.w3.org/2000/svg">
                            <title>GitHub</title>
                            <path
                                d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                        </svg>
                    </a>
                </li>
                <li>&copy; Pramono 2023</li>
            </ul>
        </nav>
        <!-- mobile sidebar end -->

        <!-- content start -->
        <main
            class="absolute inset-5 md:inset-[70px] md:w-full middle:inset-x-0 md:middle:bottom-0 middle:top-[55px] bg-slate-50">
            <!-- foto start -->
            <div class="author_image hidden md:block absolute top-0 left-0 bottom-0 w-[33%] z-[15]">
                <div class="main absolute inset-0 bg-no-repeat bg-cover bg-center grayscale"
                    style="background-image: url('img/foto.jpg');">
                </div>
            </div>
            <!-- foto end -->

            <!-- body start -->
            <div class="absolute animated flash overflow-y-scroll top-0 bottom-0 right-0 left-0 w-full">
                <div class="w-full p-2 flex items-center bg-green-50 h-[450px]">
                    <div class="md:pl-[410px]">
                        <slot></slot>
                    </div>
                </div>
            </div>
            <!-- body start -->
        </main>
        <!-- content end -->


        <!-- footer start -->
        <div
            class="cavani_tm_footer hidden fixed inset-x-0 bottom-0 bg-white z-[10] h-[70px] leading-[70px] md:flex items-center justify-between py-0 px-[70px] middle:hidden">
            <div id="copyright">
                <p class="">Copyright &copy; Pramono 2023</p>
            </div>
            <div id="social" class="flex justify-end space-x-8">
                <a href="https://www.linkedin.com/in/pramono-82a0721b9/" target="_blank">
                    <svg role="img" fill="gray" viewBox="0 0 24 24" width="30" xmlns="http://www.w3.org/2000/svg">
                        <title>LinkedIn</title>
                        <path
                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg>
                </a>
                <a href="https://gitlab.com/pramono6236" target="_blank">
                    <svg role="img" fill="gray" viewBox="0 0 24 24" width="30" xmlns="http://www.w3.org/2000/svg">
                        <title>GitLab</title>
                        <path
                            d="m23.6004 9.5927-.0337-.0862L20.3.9814a.851.851 0 0 0-.3362-.405.8748.8748 0 0 0-.9997.0539.8748.8748 0 0 0-.29.4399l-2.2055 6.748H7.5375l-2.2057-6.748a.8573.8573 0 0 0-.29-.4412.8748.8748 0 0 0-.9997-.0537.8585.8585 0 0 0-.3362.4049L.4332 9.5015l-.0325.0862a6.0657 6.0657 0 0 0 2.0119 7.0105l.0113.0087.03.0213 4.976 3.7264 2.462 1.8633 1.4995 1.1321a1.0085 1.0085 0 0 0 1.2197 0l1.4995-1.1321 2.4619-1.8633 5.006-3.7489.0125-.01a6.0682 6.0682 0 0 0 2.0094-7.003z" />
                    </svg>
                </a>
            <a href="https://github.com/pram212" target="_blank">
                <svg role="img" fill="gray" viewBox="0 0 24 24" width="30" xmlns="http://www.w3.org/2000/svg">
                    <title>GitHub</title>
                    <path
                        d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                </svg>
            </a>
        </div>
    </div>
    <!-- footer end -->
</div>
</template>

<style>
    /* mobile menu animation */
    @keyframes fadeInRightToLeft {
        from {
            opacity: 0;
            transform: translateX(100%);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }

    }

    /* The element to apply the animation to */
    #mobile-menu {
        animation: fadeInRightToLeft 300ms ease-in-out;
    }
</style>
