<script setup>
import { usePage, router, Link, useForm } from "@inertiajs/vue3";
import { pickBy } from "lodash";
import { ref, watch, toRefs } from "vue";
import Modal from "../Modal.vue";
import Input from "../Input.vue";
import ButtonPrimary from "../ButtonPrimary.vue";

const emit = defineEmits(["close"]);

const props = defineProps({ announcement: Object });
const { announcement } = toRefs(props);

const form = useForm({
    title: null,
    content: null,
    _method: "PUT",
});

watch(
    () => props.announcement,
    (announcement) => {
        form.title = announcement.title;
        form.content = announcement.content;
    },
    { deep: true }
);

const submit = () => {
    form.transform((data) => pickBy(data)).post(
        route("admin.announcements.update", announcement.value.id),
        {
            onSuccess: () => {
                const cancelButton = document.getElementById("cancelButton");
                cancelButton.click();
            },
        }
    );
};

const closeModal = () => {
    form.reset();
    emit("close");
};
</script>

<template>
    <Modal id="editAnnouncementModal" title="Edit Announcement">
        <template #body>
            <form
                @submit.prevent="form.post('/register')"
                class="needs-validation"
                novalidate
            >
                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"
                            >Title</label
                        >
                        <div class="col-sm-10">
                            <Input
                                v-model="form.title"
                                id="title"
                                class="form-control"
                                :error="form.errors.title"
                            />
                        </div>
                    </div>
                </div>
                <div class="form-outline mb-4">
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea
                            v-model="form.content"
                            class="form-control"
                            id="content"
                            rows="3"
                        />
                    </div>
                </div>
            </form>
        </template>

        <template #footer>
            <ButtonPrimary
                style="padding-left: 0.75rem; padding-right: 0.75rem"
                :disabled="form.processing"
                @click="submit"
            >
                <spring-spinner
                    v-if="form.processing"
                    :animation-duration="3000"
                    :size="20"
                    color="#fff"
                />
                <span v-else>Post</span>
            </ButtonPrimary>
            <button
                ref="cancelButton"
                id="cancelButton"
                type="button"
                class="cancel btn btn-secondary"
                data-bs-dismiss="modal"
                @click="closeModal"
            >
                Close
            </button>
        </template>
    </Modal>
</template>
