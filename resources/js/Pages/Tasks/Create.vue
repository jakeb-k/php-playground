<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Task from '@/Components/Task.vue';
import ExampleComponent from '@/Components/ExampleComponent.vue';
import { Head } from '@inertiajs/vue3';


const props = defineProps({
    tasks: Array,
})
</script>
<template>
    <AuthenticatedLayout>
        <ExampleComponent></ExampleComponent>
    </AuthenticatedLayout>
</template>