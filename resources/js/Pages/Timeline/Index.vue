<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3';
import Timeline from '@/Components/Timeline/Timeline.vue';
import StickyColumn from '@/Components/Grid/StickyColumn.vue';
import NavLink from '@/Components/Timeline/NavLink.vue';
import Unicorn from '@/Components/Icons/Unicorn.vue';

import {
    HashtagIcon,
    BellIcon,
    UserCircleIcon
} from '@heroicons/vue/24/outline/index'
import CreatePostModal from '@/Components/Modals/CreatePostModal.vue';


const timeline = computed(() => usePage().props.value.timeline)
const communities = computed(() => usePage().props.value.communities)

</script>

<template>
    <div class="flex relative divide-x divide-gray-200">
        <StickyColumn>
            <h1 class="w-full border-b border-gray-200 p-3 pl-8 sticky top-0 bg-white font-bold">Sniddl</h1>
            <ul class="pt-3 px-8 space-y-2">
                <NavLink class="hover:stroke-sky-500 hover:text-sky-500">
                    <HashtagIcon class="w-5" />
                    <span class="text-lg font-bold">FYP</span>
                </NavLink>
                <NavLink class="hover:fill-sky-500 hover:text-sky-500 stroke-0">
                    <Unicorn class="w-5 mr-1"/>
                    <span class="text-lg font-bold">New</span>
                </NavLink>
                <NavLink class="hover:stroke-sky-500 hover:text-sky-500 fill-none">
                    <BellIcon class="w-5"/>
                    <span class="text-lg font-bold">Notifications</span>
                </NavLink>
                <NavLink class="hover:stroke-sky-500 hover:text-sky-500 fill-none">
                    <UserCircleIcon class="w-5"/>
                    <span class="text-lg font-bold">Profile</span>
                </NavLink>
                <li>
                    <CreatePostModal />
                </li>
            </ul>
        </StickyColumn>

        <div class="flex-grow">
            <h1 class="w-full border-b border-gray-200 p-3 sticky top-0 bg-white font-bold">Home</h1>
            <Timeline :timeline="timeline"/>
        </div>

        <StickyColumn class="w-[30ch]">
            <h1 class="w-full border-b border-gray-200 p-3 sticky top-0 bg-white font-bold">Communities</h1>
            <ul class="divide-y divide-gray-200">
                <li v-for="community in communities">
                    <a :href="`/c/${community.url}`" class="block px-3 py-1 hover:bg-gray-100 cursor-pointer">
                        <div class="font-bold">{{ community.name }}</div>
                        <div class="text-[0.85em]">{{ community.url }}</div>
                    </a>
                </li>
            </ul>
        </StickyColumn>
    </div>

</template>
