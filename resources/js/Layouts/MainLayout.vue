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
            <div v-if="user" class="flex items-center gap-4">
                <div class="text-gray-500 relative pr-3 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                    </svg>
                    <div v-if="notificationCount" class="absolute
                        right-0
                        top-0
                        w-5
                        h-5
                        bg-red-500
                        dark:bg-red-400
                        text-white
                        font-medium
                        border
                        border-white
                        dark:border-gray-500
                        rounded-full
                        text-xs
                        text-center">
                            {{notificationCount}}
                        </div>
                </div>
                <Link :href="route('realtor.listing.index')"
                    class="text-sm text-gray-500 flex-none">
                    {{user.name}}
                </Link>
                <Link :href="route('realtor.listing.create')" class="btn-primary">
                    + New Listing
                </Link>
                <div>
                    <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                </div>
            </div>
            <div v-else class="flex items-center gap-4">
                <Link :href="route('user-account.create')">Register</Link>
                <Link :href="route('login')">Sign-In</Link>
            </div>
        </nav>
    </header>
    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess"
            class="mb-4 p-2 border rounded-md
                shadow-sm
                border-green-200
                dark:border-green-800
                bg-green-50
                dark:bg-green-800">
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
const user = computed(
    () => usePage().props.user,
)
const notificationCount = computed(
    () => Math.min(usePage().props.user.notificationCount, 9),
)
</script>
