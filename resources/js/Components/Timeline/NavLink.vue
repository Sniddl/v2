<script>
export default {
    inheritAttrs: false
}
</script>

<template>
    <li>
        <a class="navlink stroke-[2.4] stroke-slate-800" v-bind="$attrs" >
            <slot></slot>
        </a>
    </li>
</template>

<style>

    .navlink {
        @apply rounded-full hover:bg-gray-100 cursor-pointer py-3 pl-4 pr-8 inline-flex items-center space-x-1 text-lg text-slate-800
    }

    .navlink svg,
    .navlink svg > path {
        @apply stroke-inherit fill-inherit pointer-events-none
    }

</style>
