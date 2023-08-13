<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { ref, toRefs } from "vue";
import { Qalendar } from "qalendar";
import Header from "../../Components/Header.vue";
import Footer from "../../Components/Footer.vue";

import AppointmentModal from "../../Components/Modals/AppointmentModal.vue";
const props = defineProps({ appointments: Object });
const { appointments } = toRefs(props);

const events = ref(appointments.value.data);

const config = {
    // dayBoundaries: {
    //     start: 6,
    //     end: 19,
    // },
    style: {
        colorSchemes: {
            hall: {
                color: "#fff",
                backgroundColor: "#ffc107",
            },
            court: {
                color: "#fff",
                backgroundColor: "#004aad",
            },
        },
    },
};
</script>

<template>
    <Header :stop-scroll="false" active="calendar" :show-navbar="true" />
    <div id="main" style="padding: 20px">
        <div
            v-if="!usePage().props.auth.user"
            class="alert alert-warning"
            role="alert"
        >
            You need to Login first before reserving a slot <br />
            Mag login muna para makapag pareserve ng slot
        </div>
        <div v-else style="margin-bottom: 20px; text-align: center">
            <Link
                class="btn btn-primary"
                data-bs-toggle="modal"
                href="#newAppointmentModal"
                >Reserve a slot</Link
            >
        </div>
        <Qalendar :events="events" :config="config" />
    </div>

    <AppointmentModal id="newAppointmentModal" />
    <Footer :show-top-details="false" />
</template>

<style>
@import "qalendar/dist/style.css";

section.calendar-week {
    padding: 0 !important;
}
</style>
