<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Task from '@/Components/Task.vue';
import { Link } from '@inertiajs/vue3'; 
import { Head } from '@inertiajs/vue3';


const props = defineProps({
    tasks: Array,
    flash: Object,
    success_msg: String,
})
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="py-12 bg-red-500/5 h-aut">
            <div class="max-w-7xl mx-auto shadow-lg w-full bg-red-500/5">
                <div class="bg-white shadow-sm sm:rounded-lg ">
                    <div class="flex justify-between">
                        <div class="text-3xl p-6 text-gray-900">Your Tasks</div>
                        <div class="text-green-600 mt-8" v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>

                        <Link class="rounded-lg h-10 mt-5 mr-10 p-2 bg-green-400 hover:bg-white hover:border-gray-700 border-transparent border-2" 
                              href="tasks/create">Add Task</Link>

                    </div>
                    <div v-for="task in tasks">
                        <Task :task="task"></Task>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
    export default {

        mounted() {
            console.log(this.$page.props)
        }
    }
</script>
