<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3';
import Timeline from '@/Components/Timeline/Timeline.vue';
import StickyColumn from '@/Components/Grid/StickyColumn.vue';


const timeline = computed(() => usePage().props.value.timeline)
const communities = computed(() => usePage().props.value.communities)

</script>

<template>
    <div class="flex relative divide-x divide-gray-200">
        <StickyColumn>
            <h1 class="w-full border-b border-gray-200 p-3 sticky top-0 bg-white font-bold">Profile</h1>
        </StickyColumn>

        <div class="md:max-w-[60ch]">
            <h1 class="w-full border-b border-gray-200 p-3 sticky top-0 bg-white font-bold">Home</h1>
            <Timeline :timeline="timeline"/>
        </div>

        <StickyColumn>
            <h1 class="w-full border-b border-gray-200 p-3 sticky top-0 bg-white font-bold">Communities</h1>
            <ul class="divide-y divide-gray-200">
                <a :href="`/c/${community.url}`" class="block px-3 py-1 hover:bg-gray-100 cursor-pointer" v-for="community in communities">
                    <div class="font-bold">{{ community.name }}</div>
                    <div class="text-[0.85em]">{{ community.url }}</div>
                </a>
            </ul>
        </StickyColumn>
    </div>

</template>
