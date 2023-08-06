<script setup>
import { toRefs, computed } from "vue";
import Header from "../../../Components/Header.vue";
import Footer from "../../../Components/Footer.vue";
</script>

<template>
    <Header
        :stop-scroll="true"
        active="home"
        :show-navbar="true"
        :isAdmin="true"
    />
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Dashboard</h2>
                    <ol>
                        <li>Home</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- ======= Contact Section ======= -->
        <!-- <section
            class="contact"
            data-aos="fade-up"
            data-aos-easing="ease-in-out"
            data-aos-duration="500"
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>Our Address</h3>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>
                                        info@example.com<br />contact@example.com
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Call Us</h3>
                                    <p>
                                        +1 5589 55488 55<br />+1 6678 254445 41
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form
                            action="forms/contact.php"
                            method="post"
                            role="form"
                            class="php-email-form"
                        >
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        id="name"
                                        placeholder="Your Name"
                                        required
                                    />
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        id="email"
                                        placeholder="Your Email"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="subject"
                                    id="subject"
                                    placeholder="Subject"
                                    required
                                />
                            </div>
                            <div class="form-group mt-3">
                                <textarea
                                    class="form-control"
                                    name="message"
                                    rows="5"
                                    placeholder="Message"
                                    required
                                ></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">
                                    Your message has been sent. Thank you!
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Contact Section -->
    </main>
    <!-- End #main -->
    <Footer :show-top-details="false" />
</template>
