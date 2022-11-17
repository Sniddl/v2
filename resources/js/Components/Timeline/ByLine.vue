<script setup>

const user = defineProps({
    'display_name': {
        type: String,
        required: true,
    },
    'username': {
        type: String,
        required: true,
    },
})

</script>

<template>

    <div class="font-bold flex items-center leading-none">
        {{ user.display_name }}
        <div class="font-normal text-sm text-slate-400 ml-[0.5ch] leading-none flex items-center">
            <span class="text-[0.8em] font-mono leading-none flex items-center mr-[1px]">@</span>
            <span>{{ user.username }}</span>
        </div>
    </div>


</template>

