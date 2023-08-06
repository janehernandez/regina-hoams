<script setup>
import { toRefs } from "vue";
const props = defineProps({ errors: Object });
const { errors } = toRefs(props);
</script>

<template>
    <ul
        class="text-sm text-red-700"
        v-if="errors && Object.keys(errors).length > 0"
    >
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
    </ul>
</template>
