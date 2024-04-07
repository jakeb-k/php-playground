<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';

defineProps({ errors: Object })

const task = reactive({
  task: null,
  priority: 1,
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
            <span class="text-red-600" v-if="$page.props.errors.task">{{ $page.props.errors.task }}</span>

            <label for="priority" class="mb-2">Priority:</label>
            <input id="priority" type="number" min="1" max="3" v-model="task.priority" class="mb-4 rounded-md" />
            <span class="text-red-600" v-if="$page.props.errors.priority">{{ $page.props.errors.priority }}</span>

            <label for="due_date" class="mb-2">Due date:</label>
            <input id="due_date" type="date" v-model="task.due_date" class="mb-4 rounded-md"/>
            <span class="text-red-600" v-if="$page.props.errors.due_date">{{ $page.props.errors.due_date }}</span>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </form>

  
</template>