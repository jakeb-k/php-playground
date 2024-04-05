<template>
    <div>
        <div :class="getPriorityClass(task.priority)">
           <p>{{ task.task }}</p> 
            <p>{{ task.due_date }}</p>
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
                        return 'bg-red-500';
                    case 2 :
                        return 'bg-yellow-500';
                    case 3 :
                        return 'bg-green-500';
                }
            }
        },
    }
</script>
