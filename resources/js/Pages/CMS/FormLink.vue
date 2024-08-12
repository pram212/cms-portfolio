<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    link: Object,
});

const form = useForm({
    name : props.link?.name,
    url : props.link?.url,
    svg : props.link?.svg,
    icon_font : props.link?.icon_font,
    color : props.link?.color,
})

function submit()
{
    if (props.link) {
        form.put(route('links.update', props.link.id), { preserveState: 'errors' })
        return
    } 
    form.post(route('links.store'), { preserveState: 'errors' } )
}

</script>

<template>

    <Head title="link" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage Links Social Media</li>
                <li>{{ !props.link ? "Create" : "Edit"}}</li>
            </ul>
        </template>

        <div class="flex justify-start">
            <Link :href="route('links.index')" class="btn btn-sm btn-secondary capitalize">back to list</Link>
        </div>
        <div class="divider"></div>
        <form @submit.prevent="submit">
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.institution}">
                Name :
                <input type="text" class="grow" v-model="form.name" />
                <small class="text-xs text-error" v-if="form.errors.name">{{ form.errors.name }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.title}">
                URL :
                <input type="text" class="grow" v-model="form.url" />
                <small v-if="form.errors.url">{{ form.errors.url }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.start}">
                Svg :
                <input type="text" class="grow" v-model="form.svg" />
                <small class="text-xs text-error" v-if="form.errors.svg">{{ form.errors.svg }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.end}">
                Icon Font :
                <input type="text" class="grow" v-model="form.icon_font" />
                <small class="text-xs text-error" v-if="form.errors.icon_font">{{ form.errors.icon_font }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.end}">
                Color :
                <input type="text" class="grow" v-model="form.color" />
                <small class="text-xs text-error" v-if="form.errors.color">{{ form.errors.color }}</small>
            </label>
            <div class="divider"></div>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
    </AuthenticatedLayout>

</template>
