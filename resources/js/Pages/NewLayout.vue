<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div id="body" class=" bg-transparent min-h-screen">
        <nav class="navbar px-20 mt-9 hidden lg:block">
            <div class="mx-auto">
                <Link class="text-3xl mr-32 font-semibold">Pramono</Link>
                <ul class="flex space-x-6">
                    <li>
                        <Link class="btn btn-primary w-28 my-2">Home</Link>
                    </li>
                    <li>
                        <Link class="btn btn-primary w-28 my-2">About</Link>
                    </li>
                    <li>
                        <Link class="btn btn-primary w-28 my-2">Resume</Link>
                    </li>
                    <li>
                        <Link class="btn btn-primary w-28 my-2">Portfolio</Link>
                    </li>
                    <li>
                        <Link class="btn btn-primary w-28 my-2">Contact</Link>
                    </li>
                    <li>
                        <button class="rounded-full btn btn-primary">to</button>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="flex justify-center">
            <div class="avatar mt-5">
                <div class="w-60 rounded-full">
                    <img src="/img/foto.JPG" />
                </div>
            </div>
        </section>

    </div>
</template>

<script>

</script>