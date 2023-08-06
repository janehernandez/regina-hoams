<script>
export default {
    props: {
        type: {
            type: String,
            default: "submit",
        },
    },
};
</script>

<template>
    <button
        :type="type"
        class="btn btn-primary"
        style="padding-left: 2.5rem; padding-right: 2.5rem"
    >
        <slot />
    </button>
</template>
