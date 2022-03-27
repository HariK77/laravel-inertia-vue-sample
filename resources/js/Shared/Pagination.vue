<template>
    <Component
    :is="link.url ? 'Link' : 'span'"
    v-for="(link, key) in links"
    :key="key" :href="link.url"
    v-html="link.label"
    class="px-2 py-2"
    :class="{'text-gray-400' : !link.url, 'font-bold' : link.active}"
    />

    <!-- <template v-for="(link, key) in users.links" :key="key">
        <Link v-if="link.url" :href="link.ur}l" v-html="link.label" />
        <span v-else v-html="link.label"></span>
    </template> -->

</template>

<script>
export default {
    props: {
        links: Array
    }
}
</script>
