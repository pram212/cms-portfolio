<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    skill: Object,
});

const form = useForm({
    name : props.skill?.name,
    level : props.skill?.level,
    category : props.skill?.category,
})

function submit()
{
    if (props.skill) {
        form.put(route('skills.update', props.skill.id), { preserveState: true })
        return
    } 
    form.post(route('skills.store'), { preserveState: true } )
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

        <div class="flex justify-start">
            <Link href="/skills" class="btn btn-sm btn-secondary capitalize">back to list</Link>
        </div>
        <div class="divider"></div>
        <form @submit.prevent="submit">
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.name}">
                Name :
                <input type="text" class="grow" v-model="form.name" />
                <small class="text-xs text-error" v-if="form.errors.name">{{ form.errors.name }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.presentage}">
                Category :
                <input type="text" class="grow" v-model="form.category" placeholder="huruf kecil"/>
                <small v-if="form.errors.presentage">{{ form.errors.category }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.level}">
                Level :
                <select class="grow" v-model="form.level">
                    <option value="basic">Basic</option>
                    <option value="experience">Experience</option>
                    <option value="advance">Advance</option>
                </select>
                <small v-if="form.errors.level">{{ form.errors.level }}</small>
            </label>
            <div class="divider"></div>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
    </AuthenticatedLayout>

</template>
