<script setup>
import { toRefs, computed, ref } from "vue";
import dayjs from "dayjs";

import Header from "../../../Components/Header.vue";
import Footer from "../../../Components/Footer.vue";
import ButtonPrimary from "../../../Components/ButtonPrimary.vue";
import Pagination from "../../../Components/Pagination.vue";
import Table from "../../../Components/Table.vue";

import EditAnnouncement from "../../../Components/Modals/EditAnnouncement.vue";

const props = defineProps({ announcements: Object });
const { announcements } = toRefs(props);

const announcement = ref(null);
const formatPostedDate = (value) => {
    if (value) {
        return dayjs(value).format("MM/DD/YYYY h:mm A");
    }
};

const columns = [
    { name: "#", attribute: "id" },
    { name: "Title", attribute: "title" },
    { name: "Content", attribute: "content", width: "50%" },
    { name: "Date Posted", attribute: "created_at" },
    { name: "Edit / Delete", attribute: "actions" },
];
</script>

<template>
    <Header
        :stop-scroll="true"
        active="announcement"
        :show-navbar="true"
        :isAdmin="true"
    />
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Announcements</h2>
                    <!-- <ol>
                        <li>Home</li>
                        <li>Admins</li>
                    </ol> -->
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
                    <Table :resources="announcements.data" :columns="columns">
                        <template #cell-created_at="{ resource }">
                            {{ formatPostedDate(resource.created_at) }}
                        </template>
                        <template #cell-actions="{ resource }">
                            <div class="flex space-x-4 text-gray-500">
                                <a
                                    class="me-3"
                                    data-bs-toggle="modal"
                                    href="#editAnnouncementModal"
                                    @click="announcement = resource"
                                >
                                    <i class="bi bi-pen" />
                                </a>

                                <a
                                    class="me-3"
                                    data-bs-toggle="modal"
                                    href="#deletemodal"
                                    @click="
                                        $emit(
                                            'removeSubCategory',
                                            resource.hashId
                                        )
                                    "
                                    ><i class="bi bi-trash" />
                                </a>
                            </div>
                        </template>
                    </Table>

                    <Pagination :links="announcements.links" />
                    <!-- <div class="general-pagination">
                        <ul class="justify-content-center align-items-center">
                            <li
                                v-for="(link, index) in announcements.links"
                                class="page-item"
                                :class="{
                                    'd-none d-sm-block':
                                        index != 0 ||
                                        index != announcements.links.length - 1,
                                    active: link.active,
                                }"
                                :key="`link-${index}`"
                            >
                                <Link
                                    v-if="link.url"
                                    :href="link.url"
                                    class="page-link"
                                    ><span v-html="link.label"
                                /></Link>
                                <span
                                    v-else
                                    class="page-link"
                                    style="cursor: pointer"
                                    v-html="link.label"
                                />
                            </li>
                        </ul>
                    </div> -->

                    <div
                        class="text-center text-sm-start mt-4 pt-2 d-flex align-items-center justify-content-center"
                    >
                        <ButtonPrimary>Post New Announcement</ButtonPrimary>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <EditAnnouncement
        id="editAnnouncementModal"
        :announcement="announcement"
        @close="announcement = null"
    />

    <Footer :show-top-details="false" />
</template>
