<script setup>
import { toRefs, computed } from "vue";
import Header from "../../../Components/Header.vue";
import Footer from "../../../Components/Footer.vue";
import ButtonPrimary from "../../../Components/ButtonPrimary.vue";
const props = defineProps({ admins: Object });
resources / js / Pages / Index.vue;
</script>

<template>
    <Header
        :stop-scroll="true"
        active="admins"
        :show-navbar="true"
        :isAdmin="true"
    />
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Admins</h2>
                    <ol>
                        <li>Home</li>
                        <li>Admins</li>
                    </ol>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(admin, index) in data"
                                :key="`${index}-${admin.id}`"
                            >
                                <td>{{ admin.id }}</td>
                                <td>{{ admin.email }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div
                        class="text-center text-sm-start mt-4 pt-2 d-flex align-items-center justify-content-center"
                    >
                        <ButtonPrimary :disabled="form.processing">
                            <spring-spinner
                                v-if="form.processing"
                                :animation-duration="3000"
                                :size="20"
                                color="#fff"
                            />
                            <span v-else>Register new admin</span>
                        </ButtonPrimary>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->
    <Footer :show-top-details="false" />
</template>
