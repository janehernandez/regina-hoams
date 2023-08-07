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
    name: null,
    position: null,
    _method: "POST",
});

const newOfficerModal = ref(null);
const toast = useToast();
const submit = () => {
    form.transform((data) => pickBy(data)).post(route("admin.officers.store"), {
        onSuccess: () => {
            toast.success("Officer Created Successfully");
            const closeButton = document.querySelector("#closeButton");
            if (closeButton) {
                closeButton.click();
            }
        },
    });
};

onMounted(() => {
    newOfficerModal.value.$el.addEventListener("hidden.bs.modal", () =>
        emit("close")
    );
});

const closeModal = () => {
    form.reset();
    emit("close");
};
</script>

<template>
    <Modal
        id="newOfficerModal"
        ref="newOfficerModal"
        title="Create New Officer"
    >
        <template #body>
            <form class="needs-validation" novalidate>
                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"
                            >Name</label
                        >
                        <div class="col-sm-10">
                            <Input
                                v-model="form.name"
                                id="name"
                                class="form-control"
                                :error="form.errors.name"
                            />
                        </div>
                    </div>
                </div>
                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="position" class="col-sm-2 col-form-label"
                            >Position</label
                        >
                        <div class="col-sm-10">
                            <Input
                                v-model="form.position"
                                id="position"
                                class="form-control"
                                :error="form.errors.position"
                            />
                        </div>
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
                <span v-else>Create</span>
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
