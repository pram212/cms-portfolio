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
        
        <form @submit.prevent="submit">
            <QuillEditor theme="snow" contentType="html" v-model:content="form.bio"></QuillEditor>

            <div class="mt-3">
                <button class="btn btn-primary uppercase" type="submit">save</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
