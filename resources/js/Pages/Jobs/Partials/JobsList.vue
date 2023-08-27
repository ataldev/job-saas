<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    jobs: {
        type: Array,
        required: true,
    },
});

import { router } from "@inertiajs/vue3";
function deleteJob(jobId) {
    if (confirm("Are you sure you want to delete this job?")) {
        router.delete(route("jobs.destroy", jobId));
    }
}
</script>

<template>
    <section>
        <header>
            <div class="flex justify-between">
                <div>
                    <h2
                        class="text-lg font-medium text-gray-900 dark:text-gray-100"
                    >
                        Jobs List
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Here are the latest jobs listings.
                    </p>
                </div>
                <Link :href="route('jobs.create')">
                    <PrimaryButton class="mt-6">Create Job</PrimaryButton>
                </Link>
            </div>
        </header>
        <div class="mt-6 space-y-6">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                v-if="jobs.length > 0"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Job Title</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(job, index) in jobs"
                        :key="index"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <td class="px-6 py-4">{{ job.title }}</td>
                        <td class="px-6 py-4">
                            <Link
                                :href="route('jobs.show', job.id)"
                                class="me-2"
                            >
                                <PrimaryButton>View</PrimaryButton>
                            </Link>
                            <Link
                                :href="route('jobs.edit', job.id)"
                                class="me-2"
                            >
                                <PrimaryButton>Edit</PrimaryButton>
                            </Link>
                            <DangerButton @click="deleteJob(job.id)"
                                >Delete</DangerButton
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-else>No jobs found.</p>
        </div>
    </section>
</template>
