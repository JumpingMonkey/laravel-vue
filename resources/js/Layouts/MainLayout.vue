<template>

    <header class="border-b w-full border-gray-200 dark:border-gray-700 dark:bg-gray-900 bg-white">
        <div class="container mx-auto"></div>
        <nav class="p-4 flex items-center justify-between">
            <div class="text-lg font-medium">
                <Link :href="route('listing.index')">Listings</Link>
            </div>
            <div class="text-xl font-bold text-center text-indigo-600 dark:text-indigo-300 font-medium">
                <Link :href="route('listing.index')">LaraZillow</Link>
            </div>
            <div>
                <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
            </div>
        </nav>
    </header>
    <main class="container mx-auto p-4">
        <div v-if="flashSuccess" class="mb-4 p-2 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-800">
        {{ flashSuccess }}
    </div>

    <slot>Default</slot>
    </main>

   
</template>

<script setup>
import { computed } from 'vue'
import {Link, usePage} from '@inertiajs/vue3'

const flashSuccess = computed(
  () => usePage().props.flash.success,
)
</script>