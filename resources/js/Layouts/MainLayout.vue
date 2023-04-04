<template>
    <Link href="/listing">Listings</Link>&nbsp;
    <Link href="/listing/create">New listing</Link>

    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <!-- <div>{{ y }}</div> -->
    <slot>Default</slot>
</template>

<script setup>
import { computed } from 'vue'
import {Link, usePage} from '@inertiajs/vue3'

// const x = ref(0)
// const y = computed(() => x.value * 2)
const flashSuccess = computed(
  () => usePage().props.flash.success,
)
</script>

<style scoped>
    .success {
        background-color: green;
        color: white;
    }
</style>