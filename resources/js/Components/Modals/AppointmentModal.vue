<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { pickBy } from "lodash";
import { SpringSpinner } from "epic-spinners";
import { useToast } from "vue-toastification";

import Modal from "../Modal.vue";
import Input from "../Input.vue";
import Select from "../Select.vue";
import ButtonPrimary from "../ButtonPrimary.vue";

const emit = defineEmits(["close"]);

const form = useForm({
    venue: "",
    date: null,
    start: null,
    end: null,
    description: null,
    _method: "POST",
});

const newAppointmentModal = ref(null);
const toast = useToast();
const submit = () => {
    if (!form.date) {
        toast.error("Date is required", {
            timeout: 3000,
        });
        return;
    }
    if (!form.start) {
        toast.error("Start time is required", {
            timeout: 3000,
        });
        return;
    }

    if (!form.end) {
        toast.error("End time is required", {
            timeout: 3000,
        });
        return;
    }

    // Parse the input date string to a Date object
    const dateReserve = new Date(form.date);

    // Get the current date
    const currentDate = new Date();

    // Compare the input date with the current date
    if (dateReserve < currentDate) {
        toast.error("Date should not be less than the current date", {
            timeout: 3000,
        });
        return;
    }

    const start = form.date + " " + form.start;
    const end = form.date + " " + form.end;

    const startTime = new Date(start);
    const endTime = new Date(end);
    // Compare the start and end times
    if (startTime >= endTime) {
        toast.error("End time should not be the same with start time", {
            timeout: 3000,
        });

        return;
    }

    const payload = useForm({
        venue: form.venue,
        start,
        end,
        description: form.description,
        _method: "POST",
    });

    payload
        .transform((data) => pickBy(data))
        .post(route("calendar.store"), {
            onSuccess: () => {
                toast.success(
                    "Appointment Created Successfully, please wait for an approval",
                    {
                        timeout: 5000,
                    }
                );
                const closeButton = document.querySelector("#closeButton");
                if (closeButton) {
                    closeButton.click();
                }
            },
            onError: (err) => {
                if (err.venue) {
                    toast.error(err.venue, {
                        timeout: 3000,
                    });
                }
                return;
            },
        });
};

onMounted(() => {
    newAppointmentModal.value.$el.addEventListener("hidden.bs.modal", () =>
        emit("close")
    );
});

const closeModal = () => {
    form.reset();
    payload.reset();
    emit("close");
};

const venue = [
    { label: "Basketball Court", value: "0" },
    { label: "Multipurpose Hall", value: "1" },
];
</script>

<template>
    <Modal
        id="newAppointmentModal"
        ref="newAppointmentModal"
        title="Book an Appointment"
    >
        <template #body>
            <form class="needs-validation" novalidate>
                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"
                            >Venue</label
                        >
                        <div class="col-sm-10">
                            <Select
                                v-model="form.venue"
                                :options="venue"
                                :error="form.errors.venue"
                                default-label="Select Venue"
                            />

                            {{ form.errors.venue }}
                        </div>
                    </div>
                </div>
                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"
                            >Date:</label
                        >
                        <div class="col-sm-10">
                            <Input
                                v-model="form.date"
                                type="date"
                                class="form-control"
                                :error="form.errors.date"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"
                            >Start Time:</label
                        >
                        <div class="col-sm-10">
                            <Input
                                v-model="form.start"
                                type="time"
                                class="form-control"
                                :error="form.errors.start"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"
                            >End Time:</label
                        >
                        <div class="col-sm-10">
                            <Input
                                v-model="form.end"
                                type="time"
                                class="form-control"
                                :error="form.errors.end"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-outline mb-4">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"
                            >Description:</label
                        >
                        <div class="col-sm-10">
                            <Input
                                v-model="form.description"
                                class="form-control"
                                placeholder="Enter Description"
                                :error="form.errors.description"
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
                <span v-else>Book</span>
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
