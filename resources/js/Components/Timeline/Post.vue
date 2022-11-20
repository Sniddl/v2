<script setup>
    import {
        HeartIcon,
        ArrowPathRoundedSquareIcon,
        ChatBubbleLeftRightIcon
    } from '@heroicons/vue/24/outline/index'

    import confetti from 'canvas-confetti';
    import { computed, provide } from 'vue';
    import ByLine from './ByLine.vue';
    import PostContent from './PostContent.vue';
    import debounce from 'lodash/debounce';

    const emit = defineEmits([
        'liked'
    ])

    const post = defineProps({
        'text': {
            type: String,
            required: true,
        },
        'date': {
            type: String,
            required: true,
        },
        'op': {
            type: Object,
            required: true,
        },
        'user': {
            type: Object,
            required: true,
        },
        'is_repost': {
            type: Boolean,
            default: false,
        },
        'like': {
            type: Object,
            default: null
        }
    })

    provide('post', post);


    const animateLike = e => {
        const {top, right, left, bottom} = e.target.getBoundingClientRect();

        e.target.classList.toggle('liked')

        if (e.target.classList.contains('invoked')) return;

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

        e.target.classList.add('invoked')
    }

    const emitLike = debounce(() => {
        emit('liked')
    }, 200)

    const like = (e) => {
        e.target.blur();
        animateLike(e);
        emitLike();
    }

</script>

<template>
    <div class="post-wrapper">


        <div v-if="post.is_repost">
            <div class="flex items-end space-x-2 leading-none">
                <ByLine v-bind="post.user" />
                <div class="text-emerald-400 uppercase font-bold text-[0.7rem] leading-tight">repost</div>
            </div>
        </div>

        <div :class="{'repost-wrapper': post.is_repost}">
            <PostContent />
        </div>



        <!-- Footer -->
        <div class="flex items-center justify-between">

            <div class="text-slate-400">{{ post.date }}</div>

            <div class="flex items-center space-x-2 justify-end">
                <button class="action-button hover:bg-sky-100 hover:stroke-sky-600 focus:fill-sky-500 focus:stroke-sky-700">
                    <ChatBubbleLeftRightIcon class="w-5"/>
                </button>
                <button class="action-button hover:bg-emerald-100 hover:stroke-emerald-600 focus:stroke-emerald-600">
                    <ArrowPathRoundedSquareIcon class="w-5"/>
                </button>
                <button @click.prevent="like" :class="['action-button like', {'liked invoked': post.like}]">
                    <HeartIcon class="w-5"/>
                </button>
            </div>
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

    .like {
        @apply hover:bg-rose-100 hover:stroke-rose-600
    }

    .like:focus,
    .liked {
        @apply fill-rose-600 stroke-rose-600
    }

    .post-wrapper {
        @apply w-full bg-white space-y-3 p-3 pb-1 hover:bg-gray-50 cursor-pointer
    }

    .repost-wrapper {
        @apply p-3 border border-gray-100 hover:bg-gray-100 rounded cursor-pointer
    }

    .post-wrapper:hover .repost-wrapper {
        @apply border-gray-200 hover:border-gray-200
    }
</style>
