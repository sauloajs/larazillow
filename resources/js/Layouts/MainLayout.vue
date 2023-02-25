<template>
  <header class="w-full bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800">
    <div class="container mx-auto">
      <nav class="flex items-center justify-between p-4">
        <div class="text-lg">
          <Link :href="route('listing.index')">Listings</Link>
        </div>
        <div class="text-xl font-bold text-center text-indigo-600 dark:text-indigo-300">
          <Link :href="route('listing.index')">LaraZillow</Link>
        </div>
        <div v-if="user" class="flex items-center gap-4">
          <Link
            :href="route('notification.index')"
            class="relative py-2 pr-2 text-lg text-gray-500"
          >
            🔔
            <div
              v-if="notificationCount"
              class="absolute top-0 right-0 w-5 h-5 text-xs font-medium text-center text-white bg-red-700 border border-white rounded-full dark:bg-red-400 dark:border-gray-900"
            >
              {{ notificationCount }}
            </div>
          </Link>
          <Link :href="route('realtor.listing.index')" class="text-gray-400">{{ user.name }}</Link>
          <Link :href="route('realtor.listing.create')" class="p-2 font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">+ New Listing</Link>
          <Link :href="route('logout')" method="delete" as="button">Logout</Link>
        </div>
        <div v-else class="flex gap-4">
          <Link :href="route('user-account.create')">Register</Link>
          <Link :href="route('login')">Sign-In</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="container w-full p-4 mx-auto">
    <div v-if="flashSuccess" class="p-2 mb-4 border border-green-200 rounded-md shadow-sm dark:border-green-800 bg-green-50 dark:bg-green-900">
      {{ flashSuccess }}
    </div>
    <slot />
  </main>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import {computed} from 'vue'

const page = usePage()

const flashSuccess = computed(() => page.props.value.flash.success)
const user = computed(() => page.props.value.user)
const notificationCount = computed(
  () => Math.min(page.props.value.user.notificationCount, 9),
)

</script>

<style scoped>
.success {
  color: #fff;
  background-color: rgb(101, 188, 101);
}
</style>
