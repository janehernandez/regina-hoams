<template>
    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th
                    v-for="column in columns"
                    :key="`columns-${column.name}`"
                    :style="`width: ${column.width}`"
                >
                    <span :class="headClass">{{ column.name }}</span>
                </th>
            </tr>
        </thead>

        <tbody v-if="totalResources > 0">
            <tr v-for="resource in resources" :key="resource.id">
                <td
                    v-for="column in columns"
                    :key="`cell-${resource.id}-${column.name}`"
                    class="py-2"
                >
                    <slot
                        :name="`cell-${column.attribute}`"
                        v-bind="{ column, resource }"
                    >
                        {{ getResourceAttribute(resource, column.attribute) }}
                    </slot>
                </td>
            </tr>
        </tbody>

        <tbody v-else>
            <tr>
                <td class="py-2 text-center" :colspan="totalColumns">
                    No Records Found
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { split, size } from "lodash";

export default {
    props: {
        resources: {
            type: Array,
            required: true,
        },
        columns: {
            type: Array,
            required: true,
        },
        headClass: {
            type: String,
            default: null,
        },
    },
    computed: {
        totalResources() {
            return size(this.resources);
        },
        totalColumns() {
            return size(this.columns);
        },
    },
    methods: {
        getResourceAttribute(resource, attribute) {
            const nodes = split(attribute, ".");
            let key = resource;
            nodes.forEach((value) => {
                key = key[value] || "";
            });

            return key;
        },
    },
};
</script>
