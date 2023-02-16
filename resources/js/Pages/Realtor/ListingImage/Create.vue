<template>
  <Box>
    <template #header>Upload Images</template>
    <form
      @submit.prevent="upload"
    >
      <section class="flex items-center gap-2 my-4">
        <input
          type="file"
          multiple
          class="border border-gray-200 rounded-md file:px-4 file:py-2 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
          @input="addFiles"
        />
        <button
          type="submit"
          class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
          :disabled="!canUpload"
        >
          Upload
        </button>
        <button type="reset" class="btn-outline" @click="reset">Reset</button>
      </section>
      <div v-if="imageErrors.length" class="input-error">
        <div v-for="(error, index) in imageErrors" :key="index">
          {{ error }}
        </div>
      </div>
    </form>
  </Box>
  <Box v-if="listing.images.length" class="mt-4">
    <template #header>Current Images</template>
    <section class="grid grid-cols-3 gap-4 mt-4">
      <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
        <img :src="image.src" class="rounded-md" />
        <Link
          :href="route('realtor.listing.image.destroy', { listing: listing.id, image: image.id })"
          as="button"
          method="DELETE"
          class="mt-2 text-xs btn-outline"
        >
          Delete
        </Link>
      </div>
    </section>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { Inertia } from '@inertiajs/inertia'
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import NProgress from 'nprogress'

Inertia.on('progress', (e) => {
  if (e.detail.progress.percentage) {
    NProgress.set((e.detail.progress.percentage / 100) * 0.9 )
  }
})


const props = defineProps({ listing: Object })

const form = useForm({
  images: [],
})

const imageErrors = computed(() => Object.values(form.errors))

const upload = () => {
  form.post(
    route('realtor.listing.image.store', { listing: props.listing.id }),
    {
      onSuccess: () => form.reset('images'),
    },
  )
}

const addFiles = (e) => {
  for (const image of e.target.files) {
    form.images.push(image)
  }
}

const canUpload = computed(() => form.images.length)

const reset = () => form.reset('images')
</script>
