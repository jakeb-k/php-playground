<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

import NavLink from '@/Components/NavLink.vue';

import { Link } from '@inertiajs/vue3';

</script>

<template>

            <nav class="bg-white border-b border-gray-100 py-2 shadow-lg">
                <!-- Primary Navigation Menu -->
            
                        <div class="flex justify-around ">
                            <!-- Logo -->
                            <div class="shrink-0 flex justify-around items-center w-2/5 ">
                                <Link :href="route('dashboard')">
                                    <p class="font-bold text-2xl font-serif hover:underline tracking-wider"> Todo </p>
                                </Link>

                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>
                            <div class=" w-2/5 flex justify-evenly items-center">
                                <Link :href="route('profile.edit')"> {{ $page.props.auth.user.name }} </Link>
                                <Link :href="route('logout')" method="post" as="button">
                                    Log Out
                                </Link>
                            </div>
                            

                 
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot />
            </main>

</template>
