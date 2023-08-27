<script setup>
defineProps({
    job: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ job.title }}
            </h2>
        </header>
        <div class="mt-6 space-y-6">
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                There is no description field, so this dummy text will have to
                do.
            </p>
        </div>
    </section>
</template>
