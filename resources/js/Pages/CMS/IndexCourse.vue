<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import PaginationLink from "@/Components/PaginationLink.vue";
import { ref } from "vue";

const props = defineProps({
    courses: Object,
});

const id = ref(null)

function submitDelete() {
    router.delete(route('courses.destroy', id.value), { preserveState: false })
}

</script>

<template>

    <Head title="Courses" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Courses</li>
            </ul>
        </template>

        <div class="flex justify-between">
            <Link :href="route('courses.create')" class="btn btn-sm btn-primary">Add</Link>
            <!-- PAGINATION -->
            <PaginationLink :links="courses.links"></PaginationLink>
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
                    <tr v-for="(item, i) in courses.data" :key="i">
                        <th>{{ i + 1 }}</th>
                        <td>{{ item.institution }}</td>
                        <td>{{ item.start }}</td>
                        <td>{{ item.end }}</td>
                        <td>{{ item.description }}</td>
                        <td class="capitalize">
                            <Link :href="route('courses.edit', item.id)"
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
                Total Data : {{ courses.total }}
            </div>
            <!-- PAGINATION -->
            <PaginationLink :links="courses.links"></PaginationLink>
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
