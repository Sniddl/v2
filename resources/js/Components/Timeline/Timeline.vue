<script setup>
import Post from '@/Components/Timeline/Post.vue'

const props = defineProps({
    'timeline': {
        type: Array,
        required: true,
    }
})

</script>

<template>
    <div class="grid grid-cols-1 divide-y divide-gray-200 w-full mx-auto">
        <Post v-for="entry in props.timeline"
            v-bind="entry.post"
            :is_repost="entry.is_repost"
            :user="entry.user" />
    </div>
</template>
