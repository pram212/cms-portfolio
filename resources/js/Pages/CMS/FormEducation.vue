<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

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
        form.put(route('educations.update', props.education.id), { preserveState: 'errors' })
        return
    } 
    form.post(route('educations.store'), { preserveState: 'errors' } )
}

</script>

<template>

    <Head title="Education" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Education</li>
                <li>{{ !props.education ? "Create" : "Edit"}}</li>
            </ul>
        </template>

        <div class="flex justify-start">
            <Link :href="route('educations.index')" class="btn btn-sm btn-secondary capitalize">back to list</Link>
        </div>
        <div class="divider"></div>
        <form @submit.prevent="submit">
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.institution}">
                istitution :
                <input type="text" class="grow" v-model="form.institution" />
                <small class="text-xs text-error" v-if="form.errors.institution">{{ form.errors.institution }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.title}">
                Title :
                <input type="text" class="grow" v-model="form.title" />
                <small v-if="form.errors.title">{{ form.errors.title }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.start}">
                Start :
                <input type="number" class="grow" v-model="form.start" />
                <small class="text-xs text-error" v-if="form.errors.start">{{ form.errors.start }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.end}">
                End :
                <input type="number" class="grow" v-model="form.end" />
                <small class="text-xs text-error" v-if="form.errors.end">{{ form.errors.end }}</small>
            </label>
            <div class="divider"></div>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
    </AuthenticatedLayout>

</template>
