<script setup>
    import {
        HeartIcon,
        ArrowPathRoundedSquareIcon,
        ChatBubbleLeftRightIcon
    } from '@heroicons/vue/24/outline/index'

    import confetti from 'canvas-confetti';

    const props = defineProps({
        'text': {
            type: String,
            required: true,
        }
    })

    const like = (e) => {
        const {top, right, left, bottom} = e.target.getBoundingClientRect();
        console.log({right, left}, (left + right) / 2)
        confetti({
            spread: 60,
            particleCount: 10,
            gravity: 1.5,
            scalar: 0.25,
            startVelocity: 12,
            origin: {
                x: ((left + right) / 2) / window.innerWidth,
                y: ((top + bottom) / 2) / window.innerHeight
            },
            colors: [
                '#E11D48',
                '#FD6D8C',
                '#FC2150',
                '#7D3645',
                '#C91A40'
            ],
            shapes: ['square', 'circle', 'star'],
            disableForReducedMotion: true
        })

        console.log(confetti)
    }

</script>

<template>
    <div class="w-full bg-white rounded">

        <div class="p-3">
            {{ props.text }}
        </div>


        <!-- Footer -->
        <div class="flex items-center px-3 space-x-2 pb-1 justify-end">
            <button class="action-button hover:bg-sky-50 hover:stroke-sky-600 focus:fill-sky-500 focus:stroke-sky-700">
                <ChatBubbleLeftRightIcon class="w-5"/>
            </button>
            <button class="action-button hover:bg-emerald-50 hover:stroke-emerald-600 focus:stroke-emerald-600">
                <ArrowPathRoundedSquareIcon class="w-5"/>
            </button>
            <button @click.prevent="like" class="action-button hover:bg-rose-50 hover:stroke-rose-600 focus:fill-rose-600 focus:stroke-rose-600">
                <HeartIcon class="w-5"/>
            </button>
        </div>
    </div>
</template>

<style>
    .action-button {
        @apply p-1 fill-none stroke-1 rounded-full stroke-slate-500 hover:stroke-2 focus:stroke-2
    }

    .action-button svg,
    .action-button svg>path {
        @apply stroke-inherit fill-inherit pointer-events-none
    }
</style>
