<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({ portfolio: Object });

const form = reactive({
    project_title: props.portfolio?.project_title,
    type: props.portfolio?.type,
    client: props.portfolio?.client,
    start: props.portfolio?.start,
    end: props.portfolio?.end,
    images_file: props.portfolio ? JSON.parse(props.portfolio.images)?.map(item => ({ path: item, temp: null })) : [],
    description: props.portfolio?.description,
})

const submiting = ref(false)

// submit form handle
const submit = () => {
    submiting.value = true
    if (props.portfolio) 
        router.post(route('portfolios.update', props.portfolio.id), 
            { 
                _method: 'put', 
                project_title: form.project_title, 
                type: form.type, 
                client: form.client, 
                start: form.start, 
                end: form.end, 
                images_file: form.images_file, 
                description: form.description,
            }, 
            { 
                preserveState: (page) => Object.keys(page.props.errors).length,
                onFinish: visit => { submiting.value = false },
            })
    else 
        router.post(route('portfolios.store'), form, 
            { 
                preserveState: (page) => Object.keys(page.props.errors).length,
                onFinish: visit => { submiting.value = false },
            })
}

// remove images form
const removeImage = (index) => form.images_file.splice(index, 1)

// show images preview after change
const previewNewImage = (event) => {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = () => {
        const newImagePreview = reader.result;
        form.images_file.push({ path: null, file: file, temp: newImagePreview })
    };
    reader.readAsDataURL(file);
}

</script>

<template>

    <Head title="Portfolio" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Portfolio</li>
                <li>{{ !props.portfolio ? "Add" : "Edit" }}</li>
            </ul>
        </template>

        <div class="flex justify-between">
            <Link href="/portfolios" class="btn btn-sm btn-secondary capitalize">back to list</Link>
        </div>
        <div class="divider"></div>
        <form>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': $page.props.errors.project_title }">
                Project title :
                <input type="text" class="grow capitalize" v-model="form.project_title" />
                <small class="text-xs text-error" v-if="$page.props.errors.project_title">{{ $page.props.errors.project_title }}</small>
            </label>

            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': $page.props.errors.type }">
                Type :
                <input type="text" class="grow capitalize" placeholder="Web Application" v-model="form.type" />
                <small class="text-xs text-error" v-if="$page.props.errors.type">{{ $page.props.errors.type }}</small>
            </label>

            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': $page.props.errors.client }">
                client :
                <input client="text" class="grow capitalize" v-model="form.client" />
                <small class="text-xs text-error" v-if="$page.props.errors.client">{{ $page.props.errors.client }}</small>
            </label>

            <div class="flex justify-between space-x-2">
                <label
                    :class="{ 'input-error': $page.props.errors.start, 'input input-bordered w-full flex items-center gap-2 mb-3 capitalize font-semibold': true }">
                    Start :
                    <input type="date" class="grow" v-model="form.start" />
                    <small v-if="$page.props.errors.start">{{ $page.props.errors.start }}</small>
                </label>
                <label
                    :class="{ 'input-error': $page.props.errors.start, 'input input-bordered w-full flex items-center gap-2 mb-3 capitalize font-semibold': true }">
                    End :
                    <input type="date" class="grow" v-model="form.end" />
                    <small v-if="$page.props.errors.end">{{ $page.props.errors.end }}</small>
                </label>
            </div>

            <label class="form-control">
                <div class="label font-semibold">
                    <span class="label-text">Description :</span>
                    <span class="label-text-alt text-error text-xs" v-if="$page.props.errors.description">{{ $page.props.errors.description }}</span>
                </div>
                <QuillEditor theme="snow" contentType="html" v-model:content="form.description"></QuillEditor>
            </label>

            <!-- IMAGE FORM -->
            <div class="border shadow-md p-3" :class="{'border-error' : $page.props.errors.images_file}">
                <div class="flex justify-between">
                    <h1 class="font-semibold">Images</h1>
                    <input type="file" ref="fileInput" class="input hidden w-full input-bordered join-item input-sm uppercase" @change="previewNewImage" />
                    <button type="button" class="btn join-item btn-sm btn-success" @click="$refs.fileInput.click()">Add New Image</button>
                </div>
                <small class="text-error" v-if="$page.props.errors.images_file">{{ $page.props.errors.images_file }}</small>
                <div class="divider"></div>
                <div class="grid grid-cols-6 my-2">
                    <div class="avatar" v-for="(image, index) in form.images_file" :key="index">
                        <div class="w-36 rounded-xl shadow-md">
                            <button type="button" @click="removeImage(index)"
                                class="absolute top-[-7px] right-3 bg-error btn btn-sm rounded-full">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                            <img :src="image.path ?? image.temp" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- IMAGE FORM END -->

            <button type="button" @click="submit" :disabled="submiting" class="btn btn-primary btn-sm fixed bottom-5 right-5 shadow-2xl w-36">
               Save
            </button>
        </form>
    </AuthenticatedLayout>

</template>