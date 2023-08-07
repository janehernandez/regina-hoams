<script setup>
import { toRefs, computed } from "vue";
import Header from "../Components/Header.vue";
import Footer from "../Components/Footer.vue";
import dayjs from "dayjs";

import { usePage, router } from "@inertiajs/vue3";

const props = defineProps({ announcements: Object, officers: Object });
const { announcements, officers } = toRefs(props);

const formatPostedDate = (value) => {
    if (value) {
        return dayjs(value).format("DD MMMM YYYY, hh:mm:ss A");
    }
};

const isUserLoggedIn = computed(() => usePage().props.auth.user);
</script>

<template>
    <Header :stop-scroll="false" active="home" :show-navbar="true" />

    <!-- ======= Hero No Slider Section ======= -->
    <section
        id="hero-no-slider"
        class="d-flex justify-cntent-center align-items-center"
    >
        <div
            class="container position-relative"
            data-aos="fade-up"
            data-aos-delay="100"
        >
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <h2>Welcome to REGINA VILLE 2000 HOA</h2>
                    <p>
                        Ut velit est quam dolor ad a aliquid qui aliquid. Sequi
                        ea ut et est quaerat sequi nihil ut aliquam. Occaecati
                        alias dolorem mollitia ut. Similique ea voluptatem. Esse
                        doloremque accusamus repellendus deleniti vel. Minus et
                        tempore modi architecto.
                    </p>
                    <a href="" class="btn-get-started">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero No Slider Section -->

    <!-- ======= Downloadable Form Section if Logged IN ======= -->
    <section
        v-show="isUserLoggedIn"
        class="why-us section-bg"
        data-aos="fade-up"
        date-aos-delay="200"
    >
        <div class="container">
            <div class="row">
                <div class="col-lg-6 video-box">
                    <img
                        src="../../assets/img/form.jpg"
                        class="img-fluid"
                        alt=""
                    />
                </div>

                <div
                    class="col-lg-6 d-flex flex-column justify-content-center p-5"
                >
                    <div class="icon-box">
                        <div class="icon">
                            <i class="bx bx-fingerprint"></i>
                        </div>
                        <h4 class="title">
                            <a
                                href="https://res.cloudinary.com/dqlbxmeez/image/upload/v1690467543/wvb5ymmzzfmmx0kou9a9.jpg"
                                target="_blank"
                                >Download Certification Form</a
                            >
                        </h4>
                        <p class="description">
                            You can now download certification form of our brgy
                            for your sole purpose
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Downloadable Form Section if Logged IN -->

    <!-- ======= Announcements Section ======= -->
    <section class="announcements">
        <div class="container">
            <div class="section-title">
                <h2>Announcements</h2>
            </div>

            <div
                v-for="(announcement, key) in announcements.data"
                :key="key"
                class="row"
                data-aos="fade-up"
            >
                <div class="col-md-12 pt-4">
                    <h3>{{ announcement.title }}</h3>
                    <small class="fst-italic">
                        Posted on:
                        {{ formatPostedDate(announcement.created_at) }}
                    </small>
                    <p class="mt-4">{{ announcement.content }}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Announcements Section -->

    <!-- ======= Team Section ======= -->
    <section
        class="team section-bg"
        data-aos="fade-up"
        data-aos-easing="ease-in-out"
        data-aos-duration="500"
    >
        <div class="section-title">
            <h2>HOA Officers</h2>
        </div>

        <div class="container">
            <div class="row">
                <div
                    v-for="(officer, key) in officers"
                    :key="key"
                    class="col-lg-4 col-md-6 d-flex align-items-stretch"
                >
                    <div class="member">
                        <div class="member-info">
                            <h4>{{ officer.name }}</h4>
                            <span>{{ officer.position }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Section -->

    <!-- ======= Map Section ======= -->
    <section
        class="map"
        data-aos="fade-up"
        data-aos-easing="ease-in-out"
        data-aos-duration="500"
    >
        <div class="section-title mt-4">
            <h2>LOCATION</h2>
        </div>
        <div class="container-fluid p-0">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3867.0179988383506!2d120.87541487554827!3d14.252172485511286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd81fca7ce220d%3A0x4feccd38dc31d88c!2sRegina%20Ville%202000!5e0!3m2!1sen!2sph!4v1690048270799!5m2!1sen!2sph"
                width="600"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </section>
    <!-- End Map Section -->

    <Footer :show-top-details="true" />
</template>

<style scoped>
.team-members {
    padding-top: calc(var(--bs-gutter-x) * 0.5);
    padding-bottom: calc(var(--bs-gutter-x) * 0.5);
}
</style>
