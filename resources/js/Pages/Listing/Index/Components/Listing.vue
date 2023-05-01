<template>
    <Box>
        <div>
            <Link :href="route('listing.show', {listing: listing.id})">
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold"></Price>
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> pm
                    </div>

                </div>
                <ListingSpace :listing="listing" class="text-lg"></ListingSpace>
                <ListingAddress :listing="listing" class="text-gray-500"></ListingAddress>
            </Link>
        </div>
    </Box>
</template>

<script setup>
    import {Link} from "@inertiajs/vue3"
    import Price from "@/Components/Price.vue"
    import Box from "@/Components/UI/Box.vue";
    import ListingSpace from "@/Components/ListingSpace.vue";
    import ListingAddress from "@/Components/ListingAddress.vue";

    import { useMonthlyPayment } from "@/Composables/useMonthlyPayment"

    const {monthlyPayment} = useMonthlyPayment(props.listing.price, 2.5, 25)
    const props = defineProps({
            listing: Object,
        })
</script>
