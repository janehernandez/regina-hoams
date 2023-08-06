<script setup>
import { reactive } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import Header from "../../Components/Header.vue";
import Footer from "../../Components/Footer.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <Header :stop-scroll="false" active="form" :show-navbar="true" />
    <div id="main">
        <!-- ======= Our Services Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Forms</h2>
                    <ol>
                        <li>
                            <Link :href="route('home')">Home</Link>
                        </li>
                        <li>Forms</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End Our Services Section -->

        <!-- ======= Services Section ======= -->
        <section class="services">
            <div class="container">
                <div class="row">
                    <div
                        class="col-md-6 col-lg-3 d-flex align-items-stretch"
                        data-aos="fade-up"
                    >
                        <div class="icon-box icon-box-pink">
                            <div class="icon">
                                <i class="bx bxl-dribbble"></i>
                            </div>
                            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                            <p class="description">
                                Voluptatum deleniti atque corrupti quos dolores
                                et quas molestias excepturi sint occaecati
                                cupiditate non provident
                            </p>
                        </div>
                    </div>

                    <div
                        class="col-md-6 col-lg-3 d-flex align-items-stretch"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        <div class="icon-box icon-box-cyan">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4 class="title">
                                <a href="">Sed ut perspiciatis</a>
                            </h4>
                            <p class="description">
                                Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu fugiat
                                nulla pariatur
                            </p>
                        </div>
                    </div>

                    <div
                        class="col-md-6 col-lg-3 d-flex align-items-stretch"
                        data-aos="fade-up"
                        data-aos-delay="200"
                    >
                        <div class="icon-box icon-box-green">
                            <div class="icon">
                                <i class="bx bx-tachometer"></i>
                            </div>
                            <h4 class="title"><a href="">Magni Dolores</a></h4>
                            <p class="description">
                                Excepteur sint occaecat cupidatat non proident,
                                sunt in culpa qui officia deserunt mollit anim
                                id est laborum
                            </p>
                        </div>
                    </div>

                    <div
                        class="col-md-6 col-lg-3 d-flex align-items-stretch"
                        data-aos="fade-up"
                        data-aos-delay="200"
                    >
                        <div class="icon-box icon-box-blue">
                            <div class="icon"><i class="bx bx-world"></i></div>
                            <h4 class="title"><a href="">Nemo Enim</a></h4>
                            <p class="description">
                                At vero eos et accusamus et iusto odio
                                dignissimos ducimus qui blanditiis praesentium
                                voluptatum deleniti atque
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Section -->
    </div>
    <Footer :show-top-details="true" />
</template>
