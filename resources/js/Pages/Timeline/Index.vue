<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3';
import Post from '@/Components/Timeline/Post.vue'


const timeline = computed(() => usePage().props.value.timeline)

</script>

<template>
    <div class="grid grid-cols-1 mx-auto max-w-[60ch] divide-y divide-gray-200 border border-gray-200 rounded">
        <Post v-for="entry in timeline"
            v-bind="entry.post"
            :is_repost="entry.is_repost"
            :user="entry.user" />
    </div>
</template>
