<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ExampleComponent from '@/Components/ExampleComponent.vue';
import Form from '@/Components/Form.vue'; 


const props = defineProps({
    tasks: Array,
})
</script>
<template>
    <AuthenticatedLayout>
        <Form></Form>
    </AuthenticatedLayout>
</template>