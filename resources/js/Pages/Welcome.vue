<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useForm } from "@inertiajs/inertia-vue3";
import DisplayCsvRecords from "../Components/DisplayCsvRecords.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    message: String,
    errors: Object,
    articles: Object
})

const form = useForm({
    csvFile: ""
});
//route('articles.import')
const submit = () => {
    form.post(route('articles.import'), {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Welcome" />
    
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>

        <template>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                File uploaded
            </h2>
        </template>
        
        <div class="py-12">
            
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <input
                                    type="file"
                                    name="csvFile"
                                    @input="form.csvFile = $event.target.files[0]"
                                />
                                <div
                                    v-if="form.errors.csvFile"
                                    class="text-sm text-red-600"
                                >
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing }"
                            >
                                Submit
                            </button>
                        </form>
                        <p class="mt-8 text-green-600">{{ this.message }}</p>
                        <p class="mt-8 text-red-600">{{ form.errors.csvFile }}</p>
                    </div>
                    <DisplayCsvRecords :articles="articles"/>
                </div>
            </div>
        </div>
    </div>

</template>

