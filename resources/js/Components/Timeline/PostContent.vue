<script setup>

import { inject } from 'vue';
import ByLine from './ByLine.vue';

const post = inject('post')

</script>

<template>

    <div>
        <ByLine v-bind="post.op" />
        {{ post.text }}
    </div>

</template>

