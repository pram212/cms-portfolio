<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import PaginationLink from "@/Components/PaginationLink.vue";
import { ref } from "vue";

const props = defineProps({
    experiences: Object,
});

const id = ref(null)

function submitDelete() {
    router.delete(route('cms.about.experiences.destroy', id.value), { preserveState: false })
}

</script>

<template>

    <Head title="Experience" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Experience</li>
            </ul>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <div class="flex justify-between">
                        <Link :href="route('cms.about.experiences.create')" class="btn btn-sm btn-primary">Add</Link>
                        <!-- PAGINATION -->
                        <PaginationLink :links="experiences.links"></PaginationLink>
                    </div>
                    <div class="divider"></div>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr class="uppercase">
                                    <th>No</th>
                                    <th>Company</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, i) in experiences.data" :key="i">
                                    <th>{{ i + 1 }}</th>
                                    <td>{{ item.company }}</td>
                                    <td>{{ item.start }}</td>
                                    <td>{{ item.end ?? "Present" }}</td>
                                    <td>{{ item.position }}</td>
                                    <td class="capitalize">
                                        <Link :href="route('cms.about.experiences.edit', item.id)"
                                            class="btn btn-success btn-sm text-xs">edit</Link>
                                        <label for="delete_confirm_modal" @click="id = item.id;" class="btn btn-error btn-sm text-xs">delete</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between pt-5">
                        <!-- TOTAL DATA SHOW -->
                        <div class="btn-secondary btn btn-sm">
                            Total Data : {{ experiences.total }}
                        </div>
                        <!-- PAGINATION -->
                        <PaginationLink :links="experiences.links"></PaginationLink>
                    </div>
                </div>
            </div>
        </div>

        <!-- confirm delete pop up -->
        <input type="checkbox" id="delete_confirm_modal" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Confirmation!</h3>
                <p class="py-4">Are You Sure, want to delete this?</p>
                <div class="modal-action capitalize">
                    <button type="button" @click="submitDelete" class="btn btn-error">yes, delete!</button>
                    <label for="delete_confirm_modal" class="btn">cancel</label>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
