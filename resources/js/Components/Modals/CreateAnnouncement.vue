<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { pickBy } from "lodash";
import { SpringSpinner } from "epic-spinners";
import { useToast } from "vue-toastification";

import Modal from "../Modal.vue";
import Input from "../Input.vue";
import ButtonPrimary from "../ButtonPrimary.vue";

const emit = defineEmits(["close"]);

const form = useForm({
    title: null,
    content: null,
    _method: "POST",
});

const newAnnouncementModal = ref(null);
const toast = useToast();
const submit = () => {
    form.transform((data) => pickBy(data)).post(
        route("admin.announcements.store"),
        {
            onSuccess: () => {
                toast.success("Announcement Created Successfully");
                const closeButton = document.querySelector("#closeButton");
                if (closeButton) {
                    closeButton.click();
                }
            },
        }
    );
};

onMounted(() => {
    newAnnouncementModal.value.$el.addEventListener("hidden.bs.modal", () =>
        emit("close")
    );

    console.log(newAnnouncementModal.value.$el);
});

const closeModal = () => {
    form.reset();
    emit("close");
};
</script>

<template>
    <Modal
        id="newAnnouncementModal"
        ref="newAnnouncementModal"
        title="Post New Announcement"
    >
        <template #body>
            <form class="needs-validation" novalidate>
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
                ref="closeButton"
                id="closeButton"
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
