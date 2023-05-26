<template>
    <div>
        <Link :href="route('realtor.listing.index')">
            ← Go back to listings
        </Link>
    </div>
    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4 mt-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>
        <Box v-else class="flex md:col-span-7 items-center">Offer info</Box>
        <Box class="md:col-span-5">
            <template #header>Basic info</template>
            <Price :price="listing.price" class="text-2xl font-bold"></Price>
            <ListingSpace :listing="listing" class="text-lg"></ListingSpace>
            <ListingAddress :listing="listing" class="text-gray-500"></ListingAddress>
        </Box>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Box from '@/Components/UI/Box.vue';
import Price from '@/Components/Price.vue';
import ListingSpace from '@/Components/ListingSpace.vue';
import ListingAddress from '@/Components/ListingAddress.vue';
import { computed } from 'vue';

const hasOffers = computed(
    () => props.listing.offers.length,
);
const props = defineProps({
    listing: Object,
})
</script>
