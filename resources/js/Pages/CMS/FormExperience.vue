<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    experience: Object,
});

const form = useForm({
    company : props.experience?.company,
    position : props.experience?.position,
    start : props.experience?.start,
    end : props.experience?.end,
})

function submit()
{
    if (props.experience) {
        form.put(route('cms.about.experiences.update', props.experience.id), { preserveState: true })
        return
    } 
    form.post(route('cms.about.experiences.store'), { preserveState: true } )
}

</script>

<template>

    <Head title="Experience" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Experience</li>
                <li>{{ !props.experience ? "Create" : "Edit"}}</li>
            </ul>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <div class="flex justify-start">
                        <Link href="/cms/about/experiences" class="btn btn-sm btn-secondary capitalize">back to list</Link>
                    </div>
                    <div class="divider"></div>
                    <form @submit.prevent="submit">
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.company}">
                            istitution :
                            <input type="text" class="grow" v-model="form.company" />
                            <small class="text-xs text-error" v-if="form.errors.company">{{ form.errors.company }}</small>
                        </label>
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.position}">
                            Title :
                            <input type="text" class="grow" v-model="form.position" />
                            <small v-if="form.errors.position">{{ form.errors.position }}</small>
                        </label>
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.start}">
                            Start :
                            <input type="date" class="grow" v-model="form.start" />
                            <small class="text-xs text-error" v-if="form.errors.start">{{ form.errors.start }}</small>
                        </label>
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.end}">
                            End :
                            <input type="date" class="grow" v-model="form.end" />
                            <small class="text-xs text-error" v-if="form.errors.end">{{ form.errors.end }}</small>
                        </label>
                        <div class="divider"></div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
