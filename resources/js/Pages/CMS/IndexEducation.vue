<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import PaginationLink from "@/Components/PaginationLink.vue";

const props = defineProps({
    educations: Object,
});

</script>

<template>

    <Head title="About - Education" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Education</li>
            </ul>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <div class="flex justify-start">
                        <Link :href="route('cms.about.educations.create')" class="btn btn-sm btn-primary">Add</Link>
                    </div>
                    <div class="divider"></div>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr class="uppercase">
                                    <th>No</th>
                                    <th>Institution</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, i) in educations.data" :key="i">
                                    <th>{{ i + 1 }}</th>
                                    <td>{{ item.institution }}</td>
                                    <td>{{ item.start }}</td>
                                    <td>{{ item.end }}</td>
                                    <td>{{ item.title }}</td>
                                    <td>
                                        <Link :href="route('cms.about.educations.edit', item.id)" class="btn btn-success btn-sm text-xs">Edit</Link>
                                        <button type="button" class="btn btn-error btn-sm text-xs">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between pt-5">
                        <!-- PAGINATION -->
                        <PaginationLink :links="educations.links"></PaginationLink>
                        <!-- TOTAL DATA SHOW -->
                        <div class="btn-secondary btn btn-sm">
                            Total Data : {{ educations.total }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
