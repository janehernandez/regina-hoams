<script setup>
import { toRefs } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({ links: Array });
const { links } = toRefs(props);
</script>

<template>
    <div class="general-pagination">
        <ul class="justify-content-center align-items-center">
            <li
                v-for="(link, index) in links"
                class="page-item"
                :class="{
                    'd-none d-sm-block':
                        index != 0 || index != links.length - 1,
                    active: link.active,
                }"
                :key="`link-${index}`"
            >
                <Link v-if="link.url" :href="link.url" class="page-link"
                    ><span v-html="link.label"
                /></Link>
                <span
                    v-else
                    class="page-link"
                    style="cursor: pointer"
                    v-html="link.label"
                />
            </li>
        </ul>
    </div>
</template>
