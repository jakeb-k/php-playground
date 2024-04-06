<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';

const task = reactive({
  task: null,
  priority: null,
  due_date: null,
})

function submit() {
  router.post('/vue-playground/public/tasks', task)
}
</script>

<template>
        <Head title="Add Task" /> 
        <form @submit.prevent="submit" class="flex flex-col border-2 border-gray-400 mx-auto my-20 p-4 max-w-md">
            <label for="task" class="mb-2">Task:</label>
            <input id="task" v-model="task.task" class="mb-4 rounded-md"/>

            <label for="priority" class="mb-2">Priority:</label>
            <input id="priority" type="number" v-model="task.priority" class="mb-4 rounded-md"/>

            <label for="due_date" class="mb-2">Due date:</label>
            <input id="due_date" type="date" v-model="task.due_date" class="mb-4 rounded-md"/>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </form>

  
</template>