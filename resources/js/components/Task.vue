<script setup>
import { Link } from '@inertiajs/vue3'; 
</script>
<template>
    <div class="flex justify-center">
        <div :class="getPriorityClass(task.priority)">
           <p class="text-xl">{{ task.task }}</p> 
            <div class="flex flex-row justify-evenly flex-nowrap items-center mt-5 w-full">
                <Link class="rounded-lg h-10 mr-5 p-2 bg-grey-400 hover:bg-white hover:border-gray-700 border-transparent border-2" 
                      :href="'tasks/'+task.id+'/edit'">EDIT</Link>
                <button class="rounded-lg h-10 mr-5 p-2 bg-grey-400 hover:bg-white hover:border-gray-700 border-transparent border-2" @click="deleteTask(task.id)">DELETE</button>
                <p>{{ task.due_date }}</p>
            </div>
        </div>
    </div>
</template>

<script >
import { Inertia } from '@inertiajs/inertia';

    export default {
        props: {
            task: Object
        },
        methods: {
            getPriorityClass(priority) {
                switch(priority){
                    case 1 :
                        return 'my-2.5 w-1/2 rounded-md bg-red-400 px-20 py-2';
                    case 2 :
                        return 'my-2.5 w-1/2 rounded-md bg-yellow-400 px-20 py-2';
                    case 3 :
                        return 'my-2.5 w-1/2 rounded-md bg-green-400 px-20 py-2';
                }
            },
            deleteTask(taskId) {
                if (confirm('Are you sure you want to delete this task?')) {
                    Inertia.delete(`/vue-playground/public/tasks/${taskId}`, {
                    onSuccess: () => {
                        this.$inertia.replace('/dashboard');
                    }
                    });
                }
            }
        },
    }
    
</script>
