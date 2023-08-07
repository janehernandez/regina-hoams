<script setup>
import { toRefs, computed, ref } from "vue";
import dayjs from "dayjs";

import { Link } from "@inertiajs/vue3";
import Header from "../../../Components/Header.vue";
import Footer from "../../../Components/Footer.vue";
import ButtonPrimary from "../../../Components/ButtonPrimary.vue";
import Pagination from "../../../Components/Pagination.vue";
import Table from "../../../Components/Table.vue";

import EditOfficer from "../../../Components/Modals/EditOfficer.vue";
import CreateOfficer from "../../../Components/Modals/CreateOfficer.vue";
import DeleteResource from "../../../Components/Modals/DeleteResource.vue";

const props = defineProps({ officers: Object });
const { officers } = toRefs(props);

const officer = ref(null);
const officerId = ref("");

const formatPostedDate = (value) => {
    if (value) {
        return dayjs(value).format("MM/DD/YYYY h:mm A");
    }
};

const columns = [
    { name: "Name", attribute: "name" },
    { name: "Position", attribute: "position" },
    { name: "Created", attribute: "created_at" },
    { name: "Edit / Delete", attribute: "actions" },
];
</script>

<template>
    <Header
        :stop-scroll="true"
        active="officers"
        :show-navbar="true"
        :isAdmin="true"
    />
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>HOA Officers</h2>
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
                    <Table :resources="officers.data" :columns="columns">
                        <template #cell-created_at="{ resource }">
                            {{ formatPostedDate(resource.created_at) }}
                        </template>
                        <template #cell-actions="{ resource }">
                            <div class="flex space-x-4 text-gray-500">
                                <a
                                    class="me-3"
                                    data-bs-toggle="modal"
                                    href="#editOfficerModal"
                                    @click="officer = resource"
                                >
                                    <i class="bi bi-pen" />
                                </a>

                                <a
                                    class="me-3"
                                    data-bs-toggle="modal"
                                    href="#deletemodal"
                                    @click="officerId = resource.id"
                                    ><i class="bi bi-trash" />
                                </a>
                            </div>
                        </template>
                    </Table>

                    <Pagination :links="officers.links" />
                    <div
                        class="text-center text-sm-start mt-4 pt-2 d-flex align-items-center justify-content-center"
                    >
                        <Link
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            href="#newOfficerModal"
                            >Add New Officer</Link
                        >
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <EditOfficer
        id="editOfficerModal"
        :officer="officer"
        @close="officer = null"
    />

    <CreateOfficer id="newOfficerModal" />

    <DeleteResource
        :resource-id="officerId"
        confirmation-text="Delete this officer?"
        message="Removing this cannot be undone."
        action="admin.officers.destroy"
        @close="officerId = ''"
    />

    <Footer :show-top-details="false" />
</template>
