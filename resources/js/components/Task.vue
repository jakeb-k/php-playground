<template>
    <div class="flex justify-center">
        <div :class="getPriorityClass(task.priority)">
           <p class="text-xl">{{ task.task }}</p> 
            <p class="text-right">{{ task.due_date }}</p>
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
