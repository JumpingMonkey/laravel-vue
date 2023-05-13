<template>
    <Box>
        <template #header>Upload images</template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-4 my-4">
                <input class="border rounded-md file:px-4 file:py-1
                    border-gray-200 dark:border-gray-700 file:text-gray-700
                    file:dark:text-gray-400 file:border-0 file:bg-gray-200
                    file:dark:bg-gray-800 file:font-medium
                    file:hover:bg-gray-300 file:dark:hover:bg-gray-700
                    file:hover:cursor-pointer file:mr-4s"
                    type="file" multiple @input="addFiles" />
                <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
                <button type="reset" @click="reset" class="btn-outline">Reset</button>
            </section>
        </form>
    </Box>
    <Box class="mt-4">
        <template #header>Current listing images</template>
        <section class="mt-4 grid md:grid-cols-2 gap-4">
            <div v-for="image in listing.images" :key="image.id">
                <img :src="image.src" class="rounded-md" />
            </div>
        </section>
    </Box>

</template>

<script setup>
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/vue3'
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

const prop = defineProps({
        listing: Object
    })
router.on('progress', (event) => {
  if (event.detail.progress.percentage) {
    NProgress.set((event.detail.progress.percentage / 100) * 0.9)
  }
})
const canUpload = computed(() => form.images.length)

const form = useForm({
    images: []
})

const upload = () => form.post(route('realtor.listing.image.store', {listing: prop.listing}),
        {
            onSuccess: () => form.reset('images')
        }
    )

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image)
    }
}

const reset = () => form.reset('images')

</script>
