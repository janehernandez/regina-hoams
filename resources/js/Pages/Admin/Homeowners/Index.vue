<script setup>
import { toRefs, computed, ref } from "vue";
import dayjs from "dayjs";
import { useForm } from "@inertiajs/vue3";

import Header from "../../../Components/Header.vue";
import Footer from "../../../Components/Footer.vue";
import Pagination from "../../../Components/Pagination.vue";
import Table from "../../../Components/Table.vue";

const props = defineProps({ homeowners: Object });
const { homeowners } = toRefs(props);

const formatPostedDate = (value) => {
    if (value) {
        return dayjs(value).format("MM/DD/YYYY");
    }
};

const columns = [
    { name: "ID #", attribute: "member_info.id_number" },
    { name: "Full Name", attribute: "name" },
    { name: "Email", attribute: "email" },
    { name: "Address", attribute: "member_info.address" },
    { name: "Created at", attribute: "created_at" },
    { name: "Status", attribute: "member_info.status" },
    { name: "", attribute: "actions" },
];

//0 = disabled, 1 = Approved, 2 = Pending
const badge = ["danger", "success", "warning"];
const statusDesc = ["Inactive", "Active", "Pending"];
const getStatusClass = (status) => {
    return `badge-${badge[status]}`;
};
const getStatusDescription = (status) => {
    return statusDesc[status];
};

const changeStatus = (status, userId) => {
    const payload = { status };
    const form = useForm(payload);
    form.put(route("admin.homeowners.update.member.status", userId), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Header
        :stop-scroll="true"
        active="homeowners"
        :show-navbar="true"
        :isAdmin="true"
    />

    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Homeowners</h2>
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
                    <Table :resources="homeowners.data" :columns="columns">
                        <template #cell-member_info.status="{ resource }">
                            <span
                                class="badge"
                                :class="
                                    getStatusClass(resource.member_info.status)
                                "
                                >{{
                                    getStatusDescription(
                                        resource.member_info.status
                                    )
                                }}</span
                            >
                        </template>
                        <template #cell-created_at="{ resource }">
                            {{ formatPostedDate(resource.created_at) }}
                        </template>
                        <template #cell-actions="{ resource }">
                            <button
                                v-if="resource.member_info.status !== 1"
                                type="button"
                                class="btn btn-success btn-sm me-2"
                                @click="changeStatus(1, resource.id)"
                            >
                                Activate
                            </button>
                            <button
                                v-if="
                                    resource.member_info.status === 2 ||
                                    resource.member_info.status === 1
                                "
                                type="button"
                                class="btn btn-danger btn-sm"
                                @click="changeStatus(0, resource.id)"
                            >
                                Deactivate
                            </button>
                        </template>
                    </Table>

                    <Pagination :links="homeowners.links" />
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <Footer :show-top-details="false" />
</template>
