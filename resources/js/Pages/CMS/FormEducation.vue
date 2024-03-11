<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import PaginationLink from "@/Components/PaginationLink.vue";

const props = defineProps({
    education: Object,
});

const form = useForm({
    institution : props.education?.institution,
    title : props.education?.title,
    start : props.education?.start,
    end : props.education?.end,
})

function submit()
{
    if (props.education) {
        form.put(route('cms.about.educations.update', props.education.id), { preserveState: false })
        return
    } 
    form.post(route('cms.about.educations.store'), { preserveState: true } )
}

</script>

<template>

    <Head title="About - Education" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Education</li>
                <li>{{ !props.education ? "Create" : "Edit"}}</li>
            </ul>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <div class="flex justify-start">
                        <Link href="/cms/about/educations" class="btn btn-sm btn-secondary capitalize">back to list</Link>
                    </div>
                    <div class="divider"></div>
                    <form @submit.prevent="submit">
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.institution}">
                            istitution :
                            <input type="text" class="grow" v-model="form.institution" />
                        </label>
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.title}">
                            Title :
                            <input type="text" class="grow" v-model="form.title" />
                        </label>
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.start}">
                            Start :
                            <input type="text" class="grow" v-model="form.start" />
                        </label>
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.end}">
                            End :
                            <input type="text" class="grow" v-model="form.end" />
                        </label>
                        <div class="divider"></div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
