<template>
    <div class="max-w-4xl mx-auto"> <!-- container -->
        <div class="flex justify-center"> <!-- row and justify-content-center -->
            <div class="w-full md:w-2/3 lg:w-1/2"> <!-- col-md-8 -->
                <div class="bg-white shadow-lg rounded-lg"> <!-- card -->
                    <div class="bg-gray-100 p-4 rounded-t-lg font-bold"> <!-- card-header -->
                        Example Component
                    </div>

                    <div class="p-4"> <!-- card-body -->
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
