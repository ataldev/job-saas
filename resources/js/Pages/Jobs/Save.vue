<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import SaveJobForm from "./Partials/SaveJobForm.vue";

defineProps({
    job: {
        type: Object,
    },
});

const job = usePage().props.job ? usePage().props.job : { title: "" };
</script>

<template>
    <Head :title="job.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Update Job
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <SaveJobForm :job="job"></SaveJobForm>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
