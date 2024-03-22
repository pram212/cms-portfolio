<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({
    about: Object,
});

const form = useForm({
    bio: props.about?.bio,
});

const submit = () => {
    form.put(route("cms.about.about-me.update", 1), {
        onFinish: () => form.reset(),
        preserveState: false,
    })
}

</script>

<template>

    <Head title="About Me" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>About Me</li>
            </ul>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <form @submit.prevent="submit">
                        <QuillEditor theme="snow" contentType="html" v-model:content="form.bio"></QuillEditor>

                        <div class="mt-3">
                            <button class="btn btn-ptimary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
