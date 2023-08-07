<script setup>
import { router } from "@inertiajs/vue3";
import { toRefs, ref } from "vue";
import { SpringSpinner } from "epic-spinners";
import { useToast } from "vue-toastification";
import Modal from "../Modal.vue";
import ButtonPrimary from "../ButtonPrimary.vue";

const emit = defineEmits(["close"]);

const props = defineProps({
    resourceId: String,
    confirmationText: String,
    message: String,
    action: String,
});

const { resourceId, confirmationText, message, action } = toRefs(props);

const processing = ref(false);
const toast = useToast();
const deleteResource = () => {
    processing.value = true;

    router.delete(route(action.value, resourceId.value));

    processing.value = false;
    toast.success("Deleted Successfully");
    closeModal();
};

const closeModal = () => {
    emit("close");
};
</script>

<template>
    <Modal id="deletemodal" ref="deleteModal" :title="confirmationText">
        <template #body>
            <div class="row g-3">
                <div class="col-12 rounded p-3">
                    <p>{{ message }}</p>
                </div>
            </div>
        </template>

        <template #footer>
            <div class="d-flex align-content-center">
                <button
                    ref="cancelButton"
                    id="cancelButton"
                    type="button"
                    class="cancel btn btn-secondary me-2"
                    data-bs-dismiss="modal"
                    @click="closeModal"
                >
                    Cancel
                </button>

                <ButtonPrimary
                    data-bs-dismiss="modal"
                    style="padding-left: 0.75rem; padding-right: 0.75rem"
                    :disabled="processing"
                    @click="deleteResource"
                >
                    <spring-spinner
                        v-if="processing"
                        :animation-duration="3000"
                        :size="20"
                        color="#fff"
                    />
                    <span v-else>Delete</span>
                </ButtonPrimary>
            </div>
        </template>
    </Modal>
</template>
