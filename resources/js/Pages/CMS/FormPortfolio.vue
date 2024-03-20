<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link, router } from "@inertiajs/vue3";
import { reactive, ref } from "vue";

const props = defineProps({ portfolio: Object });

const form = reactive({
    project_title: props.portfolio?.project_title,
    start: props.portfolio?.start,
    end: props.portfolio?.end,
    technologies: props.portfolio ? JSON.parse(props.portfolio.technologies)?.map((item) => item) : [],
    images_file: props.portfolio ? JSON.parse(props.portfolio.images)?.map(item => ({ path: item, temp: null })) : [],
    modules: props.portfolio ? JSON.parse(props.portfolio.modules)?.map((item) => item) : [],
    description: props.portfolio?.description,
    demo: props.portfolio? JSON.parse(props.portfolio.demo) : { url: null, info: null },
})

// submit form handle
const submit = () => {
    if (props.portfolio) 
        router.post(route('cms.portfolios.update', props.portfolio.id), 
            { 
                _method: 'put', 
                project_title: form.project_title, 
                start: form.start, 
                end: form.end, 
                technologies: form.technologies, 
                images_file: form.images_file, 
                description: form.description,
                demo: form.demo,
                modules: form.modules 
            }, 
            { 
                preserveState: false 
            })
    else 
        router.post(route('cms.portfolios.store'), form, { preserveState: false })
}

// technologies handle
const techVal = ref(null)
const techInput = ref(null)
const addTech = () => { form.technologies.push(techVal.value); techVal.value = ""; techInput.value.focus(); }
const removeTech = (index) => { form.technologies.splice(index, 1); techInput.value.focus() }

// modules handle
const modulVal = ref(null)
const modulInput = ref(null)
const addModule = () => { form.modules.push(modulVal.value); modulVal.value = ""; modulInput.value.focus() }
const removeModule = (index) => { form.modules.splice(index, 1); modulInput.value.focus() }

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
                <li>{{ !props.portfolio ? "Create" : "Edit" }}</li>
            </ul>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <div class="flex justify-start">
                        <Link href="/cms/portfolios" class="btn btn-sm btn-secondary capitalize">back to list
                        </Link>
                    </div>
                    <div class="divider"></div>
                    <form @submit.prevent="submit">
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                            :class="{ 'input-error': $page.props.errors.project_title }">
                            Project title :
                            <input type="text" class="grow" v-model="form.project_title" />
                            <small class="text-xs text-error" v-if="$page.props.errors.project_title">{{ $page.props.errors.project_title }}</small>
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

                        <label class="form-control font-semibold">
                            <div class="label">
                                <span class="label-text">Description :</span>
                                <span class="label-text-alt text-error text-xs" v-if="$page.props.errors.description">{{ $page.props.errors.description }}</span>
                            </div>
                            <textarea class="textarea textarea-bordered h-24 w-full" v-model="form.description"></textarea>
                        </label>

                        <div class="flex justify-between space-x-1">
                            <!-- Technologies form -->
                            <div class="overflow-x-auto border my-2 shadow-md w-1/2 py-2" :class="{'border-error' : $page.props.errors.technologies}">
                                <table class="table table-xs">
                                    <thead class="uppercase text-center font-semibold">
                                        <tr>
                                            <th colspan="3">Technologies</th>
                                        </tr>
                                        <tr v-if="$page.props.errors.technologies">
                                            <td colspan="3" class="text-error">{{ $page.props.errors.technologies }}</td>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in form.technologies" :key="i" class="uppercase">
                                            <th>{{ i + 1 }}</th>
                                            <td><input type="text"
                                                    class="input w-full input-sm input-borered input-secondary uppercase"
                                                    v-model="form.technologies[i]"></td>
                                            <td class="text-right">
                                                <button type="button" @click="removeTech(i)"
                                                    class="btn btn-sm btn-error">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center" colspan="3">
                                                <div class="join w-full">
                                                    <input
                                                        class="input w-full input-bordered join-item input-sm uppercase"
                                                        placeholder="" ref="techInput" v-model="techVal" />
                                                    <button type="button" class="btn join-item btn-sm btn-success"
                                                        @click="addTech">Add</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Technologies form -->

                            <!-- Modules form -->
                            <div class="overflow-x-auto border my-2 shadow-md w-1/2 py-2" :class="{'border-error' : $page.props.errors.technologies}">
                                <table class="table table-xs">
                                    <thead class="uppercase text-center font-semibold">
                                        <tr>
                                            <th colspan="3">Modules</th>
                                        </tr>
                                        <tr v-if="$page.props.errors.modules">
                                            <td colspan="3" class="text-error">{{ $page.props.errors.modules }}</td>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in form.modules" :key="i" class="uppercase">
                                            <th>{{ i + 1 }}</th>
                                            <td><input type="text"
                                                    class="input w-full input-sm input-borered input-secondary uppercase"
                                                    v-model="form.modules[i]"></td>
                                            <td class="text-right">
                                                <button type="button" @click="removeModule(i)"
                                                    class="btn btn-sm btn-error">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center" colspan="3">
                                                <div class="join w-full">
                                                    <input type="text"
                                                        class="input w-full input-bordered join-item input-sm uppercase"
                                                        placeholder="" ref="modulInput" v-model="modulVal" />
                                                    <button type="button" class="btn join-item btn-sm btn-success"
                                                        @click="addModule">Add</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Modules form -->

                        </div>

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

                        <div class="border shadow-md p-3 mt-2">
                            <h3 class="font-semibold">Demo</h3>
                            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold">
                                Url :
                                <input type="text" class="grow" v-model="form.demo.url" />
                                <small class="text-xs text-error" v-if="$page.props.errors.demo">{{ $page.props.errors.demo }}</small>
                            </label>
                            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold">
                                Info :
                                <input type="text" class="grow" v-model="form.demo.info" />
                                <small class="text-xs text-error" v-if="$page.props.errors.demo">{{ $page.props.errors.demo }}</small>
                            </label>
                        </div>

                        <div class="divider"></div>

                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
