<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section class="mb-4">
        <RealtorFilters :filters="filters"/>
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{ 'border-dashed': listing.deleted_at }">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{ 'opacity-25': listing.deleted_at }">
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="listing" />
                    </div>
                    <ListingAddress :listing="listing" class="text-gray-500"/>
                </div>
                <section class="flex flex-col gap-2">
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <a :href="route('listing.show', {listing: listing.id})"
                            target="_blank"
                            class="btn-outline text-sm font-medium">Preview</a>
                        <Link :href="route('realtor.listing.edit', {listing: listing.id})"
                            class="btn-outline text-sm font-medium">Edit</Link>

                        <Link v-if="!listing.deleted_at" :href="route('realtor.listing.destroy', {listing: listing.id})"
                            method="delete" as="button"
                            class="btn-outline text-sm font-medium"
                        >
                            Delete
                        </Link>
                        <Link v-else :href="route('realtor.listing.restore', {listing: listing.id})"
                            method="put" as="button"
                            class="btn-outline text-sm font-medium"
                        >
                            Restore
                        </Link>

                    </div>
                    <div class="flex items-center gap-1">
                        <Link :href="route('realtor.listing.image.create', {listing: listing})"
                            class="btn-outline text-sm font-medium md:w-full text-center">
                            Image ({{ listing.images_count }})
                        </Link>
                    </div>
                    <div class="flex items-center gap-1">
                        <Link :href="route('realtor.listing.show', {listing: listing})"
                            class="btn-outline text-sm font-medium md:w-full text-center">
                            Offers ({{ listing.offers_count }})
                        </Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>
    <section v-if="listings.data.length" class="flex justify-center w-full mt-4 mb-4 ">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import  Box from "@/Components/UI/Box.vue";
import  Pagination from "@/Components/UI/Pagination.vue";

import  Price from "@/Components/Price.vue";
import  ListingSpace from "@/Components/ListingSpace.vue";
import  ListingAddress from "@/Components/ListingAddress.vue";
import  RealtorFilters from "@/Pages/Realtor/Index/Components/RealtorFilters.vue";
import {Link} from '@inertiajs/vue3'

    defineProps({
        listings: Object,
        filters: Object,
    })
</script>
