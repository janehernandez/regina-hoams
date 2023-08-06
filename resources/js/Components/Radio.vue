<script>
export default {
    props: {
        modelValue: {
            type: [String, Number],
            required: true,
        },
        inline: {
            type: Boolean,
            default: false,
        },
        options: {
            type: Object,
            default: {},
        },
        error: String,
    },
    emits: ["update:modelValue"],
};
</script>

<template>
    <div
        v-for="(option, index) in options"
        :key="index"
        class="form-check form-check-inline"
    >
        <input
            class="form-check-input"
            type="radio"
            :value="option.value"
            :checked="option.value === modelValue"
            @click="$emit('update:modelValue', option.value)"
        />
        <label class="form-check-label">{{ option.label }}</label>
    </div>

    <div v-if="error" class="error invalid-feedback">
        {{ error }}
    </div>
</template>

<style scoped>
.invalid-feedback {
    margin-top: 0 !important;
}
</style>
