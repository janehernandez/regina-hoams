<script>
export default {
    props: {
        hint: String,
        modelValue: [String, Number],
        error: String,
        options: {
            type: Object,
            required: true,
        },
        defaultLabel: {
            type: String,
            default: "Select",
        },
    },

    emits: ["update:modelValue", "change"],

    data() {
        return {
            selected: this.modelValue,
            optionList: null,
        };
    },

    watch: {
        modelValue(value) {
            this.selected = value;
        },
        selected(selected) {
            this.$emit("update:modelValue", selected);
            this.$emit("change", selected);
        },
        options: {
            handler(options) {
                this.optionList = [
                    { label: this.defaultLabel, value: "" },
                ].concat(options);
            },
            deep: true,
        },
    },

    mounted() {
        this.optionList = [{ label: this.defaultLabel, value: "" }].concat(
            this.options
        );
    },
};
</script>

<template>
    <select
        v-model="selected"
        :class="[error ? 'is-invalid' : '']"
        class="select form-control"
    >
        <option
            v-for="option in optionList"
            :key="`${new Date().getTime()}-${option.label}-${option.value}`"
            :value="option.value"
        >
            {{ option.label }}
        </option>
    </select>

    <div v-if="error" class="error invalid-feedback">
        {{ error }}
    </div>
</template>
