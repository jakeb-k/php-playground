<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Task from '@/Components/Task.vue';
import { Link } from '@inertiajs/vue3'; 
import { Head } from '@inertiajs/vue3';


const props = defineProps({
    tasks: Array,
})
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
       

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-3xl p-6 text-gray-900">Your Tasks</div>
                    <div v-for="task in tasks">
                        <Task :task="task"></Task>
                    </div>
                    <Link href="tasks/create">Add Task</Link>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
