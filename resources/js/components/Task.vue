<script setup>
import { Inertia } from '@inertiajs/inertia';

function deleteTask(taskId) {
      if (confirm('Are you sure you want to delete this task?')) {
        Inertia.delete(`/vue-playground/public/tasks/${taskId}`, {
          onSuccess: () => {
            this.$inertia.replace('/dashboard');
          }
        });
      }
    }
</script>
<template>
    <div class="flex justify-center">
        <div :class="getPriorityClass(task.priority)">
           <p class="text-xl">{{ task.task }}</p> 
            <div class="flex justify-evenly">
                <button @click="deleteTask(task.id)">DELETE</button>
                <p>{{ task.due_date }}</p>
            </div>
        </div>
    </div>
</template>

<script >
    export default {
        props: {
            task: Object
        },
        methods: {
            getPriorityClass(priority) {
                switch(priority){
                    case 1 :
                        return 'my-2.5 w-1/2 rounded-md bg-red-400 px-20 py-5';
                    case 2 :
                        return 'my-2.5 w-1/2 rounded-md bg-yellow-400 px-20 py-5';
                    case 3 :
                        return 'my-2.5 w-1/2 rounded-md bg-green-400 px-20 py-5';
                }
            }
        },
    }
    
</script>
