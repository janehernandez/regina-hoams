<template>
    <div class="form-check form-switch">
        <input
            v-model="proxyChecked"
            type="checkbox"
            :value="value"
            class="form-check-input"
        />
    </div>
</template>

<script>
export default {
    props: {
        checked: {
            type: Boolean,
            default: false,
        },
        value: {
            type: [Array, Object],
            default: null,
        },
    },
    emits: ["update:checked"],

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
};
</script>
