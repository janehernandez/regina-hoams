<script setup>
import { useForm } from "@inertiajs/vue3";
import { pickBy } from "lodash";
import { watch, toRefs } from "vue";
import { SpringSpinner } from "epic-spinners";
import { useToast } from "vue-toastification";

import Modal from "../Modal.vue";
import Input from "../Input.vue";
import ButtonPrimary from "../ButtonPrimary.vue";

const emit = defineEmits(["close"]);

const props = defineProps({ officer: Object });
const { officer } = toRefs(props);

const form = useForm({
    name: null,
    position: null,
    _method: "PUT",
});

watch(
    () => props.officer,
    (officer) => {
        if (officer) {
            form.name = officer.name || "";
            form.position = officer.position || "";
        }
    },
    { deep: true }
);

const toast = useToast();
const submit = () => {
    form.transform((data) => pickBy(data)).post(
        route("admin.officers.update", officer.value.id),
        {
            onSuccess: () => {
                const cancelButton = document.getElementById("cancelButton");
                toast.success("Officer detail Updated Successfully");
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
    <Modal id="editOfficerModal" title="Edit Officer Details">
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
                <span v-else>Update</span>
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
