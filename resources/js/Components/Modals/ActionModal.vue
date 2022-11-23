<script setup>

import { ref } from 'vue'
import {
Dialog,
DialogPanel,
DialogTitle,
DialogDescription,
} from '@headlessui/vue'

import {
    PlusIcon,
    XMarkIcon
} from '@heroicons/vue/24/outline/index'

const isOpen = ref(false)

function setIsOpen(value) {
    isOpen.value = value
}

</script>

<template>
    <slot name="trigger" :setIsOpen="setIsOpen" :isOpen="isOpen">
        <button @click="setIsOpen(true)"
                class="px-3 py-1 uppercase w-full rounded text-white bg-emerald-600 font-bold flex items-center justify-center space-x-2">
            <slot name="label" :isOpen="isOpen">
                <span>Action</span>
            </slot>
        </button>
    </slot>
    <Teleport to="body">
        <Dialog :open="isOpen" @close="setIsOpen" class="relative z-50">
            <!-- The backdrop, rendered as a fixed sibling to the panel container -->
            <div class="fixed inset-0 bg-black/30" aria-hidden="true" />

            <!-- Full-screen scrollable container -->
            <div class="fixed inset-0 overflow-y-auto">
            <!-- Container to center the panel -->
            <div class="flex min-h-full items-center justify-center p-4 relative">
                <!-- The actual dialog panel -->
                <DialogPanel class="max-w-screen-md inset-x-3 top-3 md:left-auto md:right-auto md:w-full absolute rounded bg-white">
                    <DialogTitle class="border-b border-gray-200 px-3 py-2 flex items-center justify-between">
                        <div>
                            <slot name="header">
                                <span class="text-lg font-bold text-slate-800">
                                    <slot name="title">Modal</slot>
                                </span>
                            </slot>
                        </div>
                        <button @click="setIsOpen(false)" class="rounded-full p-1 bg-slate-50 border hover:bg-gray-200 border-gray-200 ring-0">
                            <XMarkIcon class="w-4 stroke-[2]" />
                        </button>
                    </DialogTitle>

                    <slot name="content">
                        <div class="p-3">
                            <slot></slot>
                        </div>
                        <slot name="footer">
                            <div class="border-t border-gray-200 p-3 flex items-center justify-end w-full space-x-3">
                                <button @click="setIsOpen(false)"
                                        class="px-3 py-1 uppercase rounded text-slate-900 bg-slate-200 font-bold flex items-center justify-center space-x-2">
                                    <slot name="cancelLabel">
                                        <span>Cancel</span>
                                    </slot>
                                </button>
                                <button @click="setIsOpen(false)"
                                        class="px-3 py-1 uppercase rounded text-white bg-emerald-600 font-bold flex items-center justify-center space-x-2">
                                    <slot name="submitLabel">
                                        <span>Submit</span>
                                    </slot>
                                </button>
                            </div>
                        </slot>
                    </slot>
                </DialogPanel>
            </div>
            </div>
        </Dialog>
    </Teleport>


</template>
