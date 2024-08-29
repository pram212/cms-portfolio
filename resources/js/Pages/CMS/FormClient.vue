<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link, router } from "@inertiajs/vue3";
import { ref } from 'vue'

const props = defineProps({
    client: Object,
});

const form = useForm({
    company : props.client?.company,
    logo_file : props.client?.logo,
})

const inputLogo = ref(null);
const browseLogo = () => inputLogo.value.click()
const newLogo = ref(null);
// show images preview after change
const previewLogo = (event) => {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = () => {
        newLogo.value = reader.result;
        form.logo_file = file
    };
    reader.readAsDataURL(file);
}

function submit()
{
    if (props.client) {
        router.post(route('clients.update', props.client.id),
        {
            _method: 'put',
            company : form.company,
            logo_file : form.logo_file,
        },
        { 
            preserveState: 'errors' 
        })
        return
    } 
    form.post(route('clients.store'), { preserveState: 'errors' } )
}

</script>

<template>

    <Head title="Client" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage Client</li>
                <li>{{ !client ? "Create" : "Edit"}}</li>
            </ul>
        </template>

        <div class="flex justify-start">
            <Link :href="route('clients.index')" class="btn btn-sm btn-secondary capitalize">back to list</Link>
        </div>
        <div class="divider"></div>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-x-3">
                <div>
                    <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.institution}">
                        Company :
                        <input type="text" class="grow" v-model="form.company" />
                        <small class="text-xs text-error" v-if="form.errors.company">{{ form.errors.company }}</small>
                    </label>
                    <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold" :class="{'input-error' : form.errors.title}">
                        <button type="button" class="btn btn-sm btn-primary" @click="browseLogo">
                            {{ !client ? "Add Logo" : "Change Logo" }}
                        </button>
                    </label>
                </div>

                <div class="flex justify-center">
                    <div class="my-2 cursor-pointer" @click="browseLogo">
                        <div class="mb-3 text-secondary font-semibold text-center items-center">
                            Logo Preview
                        </div>
                        <div class="w-32 min-h-16 ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img v-if="newLogo" :src="newLogo" />
                            <img v-else :src="client?.logo" />
                        </div>
                    </div>
                </div>
                <input type="file" ref="inputLogo" class="grow hidden" @change="previewLogo" accept="image/*" />
            </div>

            <div class="divider"></div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </AuthenticatedLayout>

</template>
