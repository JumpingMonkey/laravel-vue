<template>
    <Box>
        <template #header>Upload images</template>
        <form
            enctype="multipart/form-data"
            method="POST" :action="route('realtor.listing.image.store', {listing: listing})">
            <input type="file" multiple name="images[]" />
            <button type="submit">Send</button>
        </form>
    </Box>

</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
    defineProps({
        listing: Object
    })
</script>
