<script setup>


import {
    PlusIcon,
    PaperAirplaneIcon
} from '@heroicons/vue/24/outline/index'

import ActionModal from '@/Components/Modals/ActionModal.vue';

</script>

<template>

   <ActionModal>
        <template #title>
            <slot name="title">
                Create Post
            </slot>
        </template>
        <template #trigger="{setIsOpen, isOpen}">
            <slot name="trigger" :setIsOpen="setIsOpen" :isOpen="isOpen">
                <button @click="setIsOpen(true)"
                        class="px-3 py-1 uppercase w-full rounded text-white bg-emerald-600 font-bold flex items-center justify-center space-x-2">
                        <slot name="label" :isOpen="isOpen">
                            <PlusIcon class="w-4 block stroke-[2.5]"/>
                            <span>Post</span>
                        </slot>
                </button>
            </slot>
        </template>
        <template #submitLabel>
            <PaperAirplaneIcon class="w-4 block stroke-[2.5]" />
            <span>Post</span>
        </template>

        <textarea class="w-full rounded" rows="5" placeholder="What's Up?"></textarea>
   </ActionModal>

</template>
