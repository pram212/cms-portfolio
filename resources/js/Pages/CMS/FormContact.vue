<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    contact: Object,
});

const form = useForm({
    phone: props.contact?.phone,
    email: props.contact?.email,
    address: props.contact?.address,
});

const submit = () => {
    form.put(route("contact.update", 1), {
        preserveState: 'errors',
    });
};

</script>

<template>

    <Head title="Contact" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage Contact</li>
            </ul>
        </template>

        <form @submit.prevent="submit">
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': form.errors.phone }">
                Phone :
                <input type="text" class="grow" v-model="form.phone" />
                <small class="text-xs text-error" v-if="form.errors.phone">{{ form.errors.phone
                    }}</small>
            </label>
            <label class="input input-bordered flex items-center gap-2 mb-3 capitalize font-semibold"
                :class="{ 'input-error': form.errors.email }">
                Email :
                <input type="text" class="grow" v-model="form.email" />
                <small class="text-xs text-error" v-if="form.errors.email">{{ form.errors.email
                    }}</small>
            </label>
            <label class="form-control font-semibold">
                <div class="label">
                    <span class="label-text">Address :</span>
                    <span class="label-text-alt text-error text-xs" v-if="form.errors.address">{{ form.errors.address }}</span>
                </div>
                <textarea class="textarea textarea-bordered h-24 w-full" v-model="form.address"></textarea>
            </label>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
