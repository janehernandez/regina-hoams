<script>
export default {
    props: {
        modelValue: String,
        icon: String,
        hint: String,
        placeholder: String,
        error: String,
        type: {
            type: String,
            default: "text",
        },
        parentClass: String
    },

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },

        handleChange(event) {
            if (this.type == "file") {
                this.$emit("update:modelValue", this.$refs.input.files[0]);
            } else {
                this.$emit("update:modelValue", event.target.value);
            }
        },
    },
};
</script>

<template>
    <div class="form-outline">
        <input
            :class="[error ? 'is-invalid' : '']"
            class="form-control"
            :type="type"
            :value="modelValue"
            :placeholder="placeholder"
            ref="input"
            @change="handleChange"
        />
    </div>
    <div v-if="error" class="error invalid-feedback">
        {{ error }}
    </div>
</template>
