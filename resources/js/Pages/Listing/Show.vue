<template>
    <div>
        <ListingAddress :listing="listing"></ListingAddress>
    </div>
    <Link :href="/listing/">Show all listings</Link>
</template>

<script setup>
import {Link} from "@inertiajs/vue3"
import ListingAddress from "../../Components/ListingAddress.vue";
    defineProps({
        listing: Object
    })
</script>