<script setup>
import { toRefs, computed, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import dayjs from "dayjs";

import Header from "../../../Components/Header.vue";
import Footer from "../../../Components/Footer.vue";
import Pagination from "../../../Components/Pagination.vue";
import Table from "../../../Components/Table.vue";

import DeleteResource from "../../../Components/Modals/DeleteResource.vue";

const props = defineProps({ appointments: Object });

const { appointments } = toRefs(props);

const formatPostedDate = (value) => {
    if (value) {
        return dayjs(value).format("MM/DD/YYYY h:mm A");
    }
};

const columns = [
    { name: "Booking Number", attribute: "booking_number" },
    { name: "Name", attribute: "user.name" },
    { name: "Venue", attribute: "venue" },
    { name: "Start Time", attribute: "start" },
    { name: "End Time", attribute: "end" },
    { name: "Status", attribute: "active" },
    { name: "Actions", attribute: "actions" },
];

const venue = ["Basketball Court", "Multipurpose Hall"];

//0 = inactive, 1 = Active
const badge = ["danger", "success"];
const statusDesc = ["Inactive", "Active"];

const getStatusClass = (status) => {
    return `badge-${badge[status]}`;
};
const getStatusDescription = (status) => {
    return statusDesc[status];
};

const isReservationEnded = (endTime) => {
    const reservationEndTime = new Date(endTime);
    const currentDateTime = new Date();

    return currentDateTime > reservationEndTime;
};

const approve = (id, userId) => {
    const payload = { id };
    const form = useForm(payload);
    form.put(route("admin.appointments.approve", userId), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Header
        :stop-scroll="true"
        active="appointment"
        :show-navbar="true"
        :isAdmin="true"
    />
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Appointments</h2>
                </div>
            </div>
        </section>

        <section
            class="contact"
            data-aos="fade-up"
            data-aos-easing="ease-in-out"
            data-aos-duration="500"
        >
            <div class="container">
                <div class="row">
                    <Table :resources="appointments.data" :columns="columns">
                        <template #cell-venue="{ resource }">
                            {{ venue[resource.venue] }}
                        </template>
                        <template #cell-start="{ resource }">
                            {{ formatPostedDate(resource.start) }}
                        </template>
                        <template #cell-end="{ resource }">
                            {{ formatPostedDate(resource.end) }}
                        </template>

                        <template #cell-active="{ resource }">
                            <span
                                class="badge"
                                :class="getStatusClass(resource.active)"
                                >{{
                                    getStatusDescription(resource.active)
                                }}</span
                            >
                        </template>

                        <template #cell-actions="{ resource }">
                            <button
                                v-if="
                                    !isReservationEnded(resource.end) &&
                                    resource.active === 0
                                "
                                type="button"
                                class="btn btn-success btn-sm me-2"
                                @click="approve(resource.id, resource.user_id)"
                            >
                                Approve Reservation
                            </button>
                        </template>
                    </Table>

                    <Pagination :links="appointments.links" />
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <Footer :show-top-details="false" />
</template>
