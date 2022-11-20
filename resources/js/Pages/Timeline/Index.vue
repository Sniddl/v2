<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3';
import Timeline from '@/Components/Timeline/Timeline.vue';
import StickyColumn from '@/Components/Grid/StickyColumn.vue';


const timeline = computed(() => usePage().props.value.timeline)

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
        </StickyColumn>
    </div>

</template>
