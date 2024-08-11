<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    biodata: Object,
});

const form = useForm({
    name: props.biodata?.name,
    photo_file: props.biodata?.photo,
    passion: props.biodata?.passion,
});

const submit = () => {
    form.post(route("biodata.update"), {
        onFinish: () => form.reset(),
        preserveState: false
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage Home</li> 
            </ul>
        </template>

        <div class="text-center">
            <div class="avatar">
                <div class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img :src="biodata?.photo" />
                </div>
            </div>
        </div>

        <div class="divider divider-neutral"></div>
        
        <form @submit.prevent="submit">

            <label class="input input-bordered flex items-center gap-2 mb-3">
                Name :
                <input type="text" class="grow" placeholder="Daisy" v-model="form.name" />
            </label>
            <InputError class="mt-2" :message="form.errors.name" />
            <label class="input input-bordered flex items-center gap-2 mb-3">
                Passion :
                <input type="text" class="grow" placeholder="Web Developer" v-model="form.passion" />
            </label>
            <InputError class="mt-2" :message="form.errors.name" />
            <label class="input input-bordered flex items-center gap-2">
                Change Photo  :
                <input type="file" class="grow" @input="form.photo_file = $event.target.files[0]" />
            </label>
            <InputError class="mt-2" :message="form.errors.photo_file" />

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
