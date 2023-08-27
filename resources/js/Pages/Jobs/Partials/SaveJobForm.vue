<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";

defineProps({
    job: {
        type: Object,
    },
});
const job = usePage().props.job ? usePage().props.job : { title: "" };
const form = useForm({
    title: job.title,
});
function handleSubmit() {
    if (this.job.id) {
        form.patch(route("jobs.update", job.id));
    } else {
        form.post(route("jobs.store"));
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Save Job
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Fill out the form below to save this job.
            </p>
        </header>

        <form
            v-if="job"
            @submit.prevent="handleSubmit()"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="title"
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
