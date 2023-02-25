<template>
  <h1 class="mb-4 text-3xl">Your Notifications</h1>
  <Box
    v-if="notifications.data.length"
    class="text-gray dark:text-gray-400"
  >
    <div
      v-for="notification in notifications.data" :key="notification.id"
      class="flex items-center justify-between py-4 border-b border-gray-200 dark:border-gray-800"
    >
      <div>
        <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
          Offer
          <Price :price="notification.data.amount" /> for
          <Link
            :href="route('realtor.listing.show', { listing: notification.data.listing_id })"
            class="text-indigo-600 dark:text-indigo-400"
          >
            listing
          </Link>
          was made
        </span>
      </div>
      <div>
        <Link
          v-if="!notification.read_at"
          :href="route('notification.seen', { notification: notification.id })"
          as="button"
          method="put"
          class="text-xs font-medium uppercase btn-outline"
        >
          Mark as read
        </Link>
      </div>
    </div>
  </Box>
  <EmptyState v-else>No notifications yet</EmptyState>

  <section
    v-if="notifications.data.length"
    class="flex w-full mt-8 mb-8 last:justify-center"
  >
    <Pagination :links="notifications.links" />
  </section>
</template>

<script setup>
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'
import Pagination from '@/Components/UI/Pagination.vue';
import { Link } from '@inertiajs/inertia-vue3';
defineProps({
  notifications: Array,
})
</script>
