<script>
export default {
    inheritAttrs: false
}
</script>

<template>
    <div class="md:block hidden">
        <div class="sticky top-0" v-bind="$attrs">
            <slot></slot>
        </div>
    </div>
</template>
