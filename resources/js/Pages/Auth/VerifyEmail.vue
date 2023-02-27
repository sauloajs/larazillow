<template>
  <div>You need to be verified first to see this page!</div>
  <div>
    <Link
      as="button"
      method="POST"
      :href="route('verification.send')"
      class="text-indigo-600 dark:text-indigo-400"
    >
      Resend verification email
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>
