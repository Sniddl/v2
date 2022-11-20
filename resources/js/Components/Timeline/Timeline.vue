<script setup>
import Post from '@/Components/Timeline/Post.vue'

const props = defineProps({
    'timeline': {
        type: Array,
        required: true,
    }
})

const toggleLike = timeline => {
    axios.post(route('like', {timeline}))
}

</script>

<template>
    <div class="grid grid-cols-1 divide-y divide-gray-200 w-full mx-auto">
        <Post v-for="entry in props.timeline"
            v-bind="entry.post"
            :is_repost="entry.is_repost"
            :user="entry.user"
            :like="entry.auth_like"
            @liked="toggleLike(entry)"
            />
    </div>
</template>
