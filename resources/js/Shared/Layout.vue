<template>
  <section class="p-6 bg-gray-200">
      <header class="flex justify-between">
          <div class="flex item">
            <h1 class="text-3xl">
              My App
            </h1>
            <p class="text-sm ml-4">
                Welcome Back, {{ username }}
            </p>
          </div>
          <Nav></Nav>
      </header>
  </section>
  <section class="p-6">
      <div class="max-w-3xl mx-auto">
          <slot />
      </div>
  </section>
</template>

<script>

import Nav from './Nav'

export default {
    components: {
        Nav,
    },
    computed: {
        username() {
            return this.$page.props.auth.user.username
        }
    }
}
</script>

<style>

</style>
