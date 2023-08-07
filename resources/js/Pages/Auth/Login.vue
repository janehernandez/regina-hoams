<script setup>
import { usePage, Link, useForm } from "@inertiajs/vue3";
import { SpringSpinner } from "epic-spinners";
import Header from "../../Components/Header.vue";
import Footer from "../../Components/Footer.vue";
import Input from "../../Components/Input.vue";
import ButtonPrimary from "../../Components/ButtonPrimary.vue";

const form = useForm({
    email: null,
    password: null,
    _token: usePage().props.csrf_token,
});
</script>

<template>
    <section class="vh-100">
        <Header :stop-scroll="true" active="login" :show-navbar="true" />
        <div class="container-fluid h-custom">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                <div class="col-md-9 col-lg-6 col-xl-5 flex-logo">
                    <img
                        src="../../../assets/img/logo.png"
                        class="img-fluid"
                        alt="Sample image"
                    />
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form @submit.prevent="form.post('/login')">
                        <!-- Email input -->
                        <div class="mb-4">
                            <Input
                                v-model="form.email"
                                type="email"
                                id="email"
                                class="mb-4"
                                placeholder="Enter a valid email address"
                                :error="form.errors.email"
                            />
                        </div>

                        <!-- Password input -->
                        <div class="mb-3">
                            <Input
                                v-model="form.password"
                                type="password"
                                id="password"
                                placeholder="Enter password"
                                :error="form.errors.password"
                            />
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <ButtonPrimary :disabled="form.processing">
                                <spring-spinner
                                    v-if="form.processing"
                                    :animation-duration="3000"
                                    :size="20"
                                    color="#fff"
                                />
                                <span v-else>Login</span>
                            </ButtonPrimary>

                            <p class="small fw-bold mt-2 pt-1 mb-0">
                                Don't have an account?
                                <Link
                                    :href="route('register.index')"
                                    class="link-danger"
                                    >Register</Link
                                >
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Footer :show-top-details="false" />
    </section>
</template>

<style scoped>
section {
    padding: 0 !important;
}
.btn-primary {
    background: #1e4356 !important;
    border-color: #1e4356 !important;
}
.flex-logo {
    display: flex;
    align-items: center;
    justify-content: center;
}
.divider:after,
.divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}
.h-custom {
    height: calc(100% - 81px);
}
@media (max-width: 450px) {
    .h-custom {
        height: 100%;
    }
}
@media (max-width: 991px) {
    .flex-logo img {
        margin-top: 1.5em;
        height: 400px;
    }
}
</style>
