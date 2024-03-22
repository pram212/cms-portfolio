<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    course: Object,
});

const form = useForm({
    institution: props.course?.institution,
    description: props.course?.description,
    start: props.course?.start,
    end: props.course?.end,
})

function submit() {
    if (props.course) {
        form.put(route('cms.about.courses.update', props.course.id), { preserveState: true })
        return
    }
    form.post(route('cms.about.courses.store'), { preserveState: true })
}

</script>

<template>

    <Head title="About - course" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Course</li>
                <li>{{ !props.course ? "Create" : "Edit" }}</li>
            </ul>
        </template>

        <div class="flex justify-start">
            <Link href="/cms/about/courses" class="btn btn-sm btn-secondary capitalize">back to list</Link>
        </div>
        <div class="divider"></div>
        <form @submit.prevent="submit">
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': form.errors.institution }">
                istitution :
                <input type="text" class="grow" v-model="form.institution" />
                <small class="text-xs text-error" v-if="form.errors.institution">{{ form.errors.institution
                    }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': form.errors.start }">
                Start :
                <input type="date" class="grow" v-model="form.start" />
                <small class="text-xs text-error" v-if="form.errors.start">{{ form.errors.start }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': form.errors.end }">
                End :
                <input type="date" class="grow" v-model="form.end" />
                <small class="text-xs text-error" v-if="form.errors.end">{{ form.errors.end }}</small>
            </label>
            <label class="form-control font-semibold">
                <div class="label">
                    <span class="label-text">Description :</span>
                    <span class="label-text-alt text-error text-xs" v-if="form.errors.description">{{ form.errors.description }}</span>
                </div>
                <textarea class="textarea textarea-bordered h-24 w-full"
                    v-model="form.description"></textarea>
            </label>

            <div class="divider"></div>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
        
    </AuthenticatedLayout>

</template>
