<template>
    <div class="grid gap-3 p-3 bg-white border rounded-lg shadow-sm">
        <div>
            <h1 class="text-xl font-bold">
                {{ props.title }}
            </h1>
        </div>
        <div>
            <slot />
        </div>
        <div>
            <slot name="footer" />
        </div>
    </div>
</template>

<script setup>
let props = defineProps({
    title: String
})
</script>

