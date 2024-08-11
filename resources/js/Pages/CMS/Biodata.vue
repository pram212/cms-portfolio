<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { ref } from 'vue'

const props = defineProps({
    biodata: Object,
});


const inputPhoto = ref(null);
const browsePhoto = () => inputPhoto.value.click()
const newPhoto = ref(null);
// show images preview after change
const previewPhoto = (event) => {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = () => {
        newPhoto.value = reader.result;
        form.req_photo = file
    };
    reader.readAsDataURL(file);
}

const inputPhoto2 = ref(null);
const browsePhoto2 = () => inputPhoto2.value.click()
const newPhoto2 = ref(null);
// show images preview after change
const previewPhoto2 = (event) => {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = () => {
        newPhoto2.value = reader.result;
        form.req_photo2 = file
    };
    reader.readAsDataURL(file);
}

const form = useForm({
    name: props.biodata?.name,
    birthday: props.biodata?.birthday,
    title: props.biodata?.title,
    degree: props.biodata?.degree,
    summary: props.biodata?.summary,
    req_photo: props.biodata?.photo,
    req_photo2: props.biodata?.photo2,
});

const submit = () => {
    form.post(route("biodata.update"), {
        onError: errors => { console.log(errors) },
        preserveState: false,
    });
};
</script>

<template>
    <Head title="Biodata" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage Biodata</li> 
            </ul>
        </template>

        <div class="flex justify-center space-x-6">
            <div>
                <p>Photo 1</p>
                <div class="divider"></div>
                <div class="avatar my-2 cursor-pointer" @click="browsePhoto">
                    <div class="w-32 ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img v-if="newPhoto" :src="newPhoto" />
                        <img v-else :src="biodata?.photo" />
                    </div>
                </div>
                <input type="file" ref="inputPhoto" class="grow hidden" @change="previewPhoto" accept="image/*" />
            </div>
            <div>
                <p>Photo 2</p>
                <div class="divider"></div>
                <div class="avatar my-2 cursor-pointer" @click="browsePhoto2">
                    <div class="w-32 ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img v-if="newPhoto2" :src="newPhoto2" />
                        <img v-else :src="biodata?.photo2" />
                    </div>
                </div>
                <input type="file" ref="inputPhoto2" class="grow hidden" @change="previewPhoto2" accept="image/*" />
            </div>
        </div>

        <div class="divider"></div>
        
        <form @submit.prevent="submit" class="md:grid md:grid-cols-2 md:gap-3">
            <div>
                <label class="input input-bordered flex items-center gap-2 mb-3">
                    Name :
                    <input type="text" class="grow" placeholder="Daisy" v-model="form.name" />
                </label>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <label class="input input-bordered flex items-center gap-2 mb-3">
                    Birthday :
                    <input type="date" class="grow" placeholder="Daisy" v-model="form.birthday" />
                </label>
                <InputError class="mt-2" :message="form.errors.birthday" />
            </div>

            <div>
                <label class="input input-bordered flex items-center gap-2 mb-3">
                    Title :
                    <input type="text" class="grow" placeholder="Web Developer" v-model="form.title" />
                </label>
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <label class="input input-bordered flex items-center gap-2 mb-3">
                    Degree :
                    <input type="text" class="grow" placeholder="Web Developer" v-model="form.degree" />
                </label>
                <InputError class="mt-2" :message="form.errors.degree" />
            </div>

            <div class="md:col-span-2">
                <label for="" class="form-control">
                    <div class="label">
                        <span class="label-text">Summary : </span>
                    </div>
                    <textarea class="textarea w-full" placeholder="Bio" v-model="form.summary"></textarea>
                </label>
                <InputError class="mt-2" :message="form.errors.summary" />
            </div>

            <div class="mt-3 md:col-span-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>

        </form>
    </AuthenticatedLayout>
</template>
