<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import PaginationLink from "@/Components/PaginationLink.vue";
import { ref } from "vue";

const props = defineProps({
    skills: Object,
});

const id = ref(null)

function submitDelete() {
    router.delete(route('cms.about.skills.destroy', id.value), { preserveState: false })
}

</script>

<template>

    <Head title="Skill" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <ul>
                <li>Manage About</li>
                <li>Skills</li>
            </ul>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <div class="flex justify-between">
                        <Link :href="route('cms.about.skills.create')" class="btn btn-sm btn-primary">Add</Link>
                        <!-- PAGINATION -->
                        <PaginationLink :links="skills.links"></PaginationLink>
                    </div>
                    <div class="divider"></div>
                    <div class="overflow-x-auto">
                        <table class="table table-sm">
                            <!-- head -->
                            <thead>
                                <tr class="uppercase">
                                    <th>No</th>
                                    <th>Programming</th>
                                    <th>Presentage</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, i) in skills.data" :key="i">
                                    <th>{{ i + 1 }}</th>
                                    <td>{{ item.name }}</td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="w-10">{{ item.presentage }} %</span>
                                            <progress :value="item.presentage" max="100" class="h-[6px] text-neutral-700 w-full progress-primary"></progress>
                                        </div>
                                    </td>
                                    <td class="capitalize text-center">
                                        <Link :href="route('cms.about.skills.edit', item.id)"
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
                            Total Data : {{ skills.total }}
                        </div>
                        <!-- PAGINATION -->
                        <PaginationLink :links="skills.links"></PaginationLink>
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
