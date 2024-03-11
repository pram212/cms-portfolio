<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    skill: Object,
});

const form = useForm({
    name : props.skill?.name,
    presentage : props.skill?.presentage,
})

function submit()
{
    if (props.skill) {
        form.put(route('cms.about.skills.update', props.skill.id), { preserveState: true })
        return
    } 
    form.post(route('cms.about.skills.store'), { preserveState: true } )
}

</script>

<template>

    <Head title="Skill" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Skill</li>
                <li>{{ !props.skill ? "Create" : "Edit"}}</li>
            </ul>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <div class="flex justify-start">
                        <Link href="/cms/about/skills" class="btn btn-sm btn-secondary capitalize">back to list</Link>
                    </div>
                    <div class="divider"></div>
                    <form @submit.prevent="submit">
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.name}">
                            Name :
                            <input type="text" class="grow" v-model="form.name" />
                            <small class="text-xs text-error" v-if="form.errors.name">{{ form.errors.name }}</small>
                        </label>
                        <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.presentage}">
                            Presentage :
                            <input type="number" class="grow" v-model="form.presentage" />
                            <small v-if="form.errors.presentage">{{ form.errors.presentage }}</small>
                        </label>
                      
                        <div class="divider"></div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
