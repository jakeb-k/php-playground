<script setup>
import { Head } from '@inertiajs/vue3';
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

            <button type="submit" @click="updateTask()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </form>

  
</template>
<script>
import { router } from '@inertiajs/vue3';

export default {
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
