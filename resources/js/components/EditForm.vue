<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
        <Head title="Add Task" /> 
        <form @submit.prevent="submit" class="flex flex-col border-2 border-gray-400 mx-auto my-20 p-4 max-w-md">
            <label for="task" class="mb-2">Task:</label>
            <input id="task" v-model="task.task" class="mb-4 rounded-md"/>
            <span class="text-red-600" v-if="$page.props.errors.task">{{ $page.props.errors.task }}</span>

            <label for="priority" class="mb-2">Priority:</label>
            <input id="priority" type="number" min="0" max="3" v-model="task.priority" class="mb-4 rounded-md"/>
            <span class="text-red-600" v-if="$page.props.errors.priority">{{ $page.props.errors.priority }}</span>

            <label for="due_date" class="mb-2">Due date:</label>
            <input id="due_date" type="date" v-model="task.due_date" class="mb-4 rounded-md"/>
            <span class="text-red-600" v-if="$page.props.errors.due_date">{{ $page.props.errors.due_date }}</span>

            <button type="submit" @click="updateTask()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </form>

  
</template>
<script>
import { router } from '@inertiajs/vue3';

export default {
  props: {
     errors: Object 
  },
  mounted() {
    console.log(this.$page.props.task); // Accessing the task object
  },
  computed: {
    task() {
      return this.$page.props.task;
    }
  },
  methods: {
    updateTask(){
        router.put(`/vue-playground/public/tasks/${this.$page.props.task.id}`, this.$page.props.task)
    }
  }
}
</script>
