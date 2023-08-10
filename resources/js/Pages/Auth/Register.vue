<script setup>
import { useForm } from "@inertiajs/vue3";
import { SpringSpinner } from "epic-spinners";
import Header from "../../Components/Header.vue";
import Footer from "../../Components/Footer.vue";
import Input from "../../Components/Input.vue";
import Radio from "../../Components/Radio.vue";
import ButtonPrimary from "../../Components/ButtonPrimary.vue";
import Select from "../../Components/Select.vue";

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
    gender: "",
    civil_status: "",
    mobile_number: "",
    birthdate: "",
    block: "",
    lot: "",
});

const blkNum = Array.from({ length: 50 }, (_, index) => ({
    label: `Blk ${(index + 1).toString()}`,
    value: index + 1,
}));

const lotNum = Array.from({ length: 50 }, (_, index) => ({
    label: `Lot ${(index + 1).toString()}`,
    value: index + 1,
}));

const gender = [
    { label: "Female", value: "0" },
    { label: "Male", value: "1" },
];

const civilStatus = [
    { label: "Single", value: "1" },
    { label: "Married", value: "2" },
    { label: "Widowed", value: "3" },
    { label: "Separated", value: "4" },
];
</script>

<template>
    <section class="h-100 bg-dark">
        <Header :stop-scroll="true" active="register" :show-navbar="false" />

        <div class="container py-5 h-100">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img
                                    src="../../../assets/img/logo.png"
                                    alt="Sample photo"
                                    class="img-fluid"
                                    style="
                                        border-top-left-radius: 0.25rem;
                                        border-bottom-left-radius: 0.25rem;
                                    "
                                />
                            </div>
                            <div class="col-xl-6">
                                <form
                                    @submit.prevent="form.post('/register')"
                                    class="needs-validation"
                                    novalidate
                                >
                                    <div class="card-body p-md-5 text-black">
                                        <h3 class="mb-5 text-uppercase">
                                            Homeowners registration form
                                        </h3>

                                        <div class="form-outline mb-4">
                                            <Input
                                                v-model="form.email"
                                                type="email"
                                                id="email"
                                                class="form-control"
                                                placeholder="Enter your preferred email"
                                                :error="form.errors.email"
                                            />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <Input
                                                v-model="form.password"
                                                type="password"
                                                id="password"
                                                class="form-control"
                                                placeholder="Enter your preferred password"
                                                :error="form.errors.password"
                                            />
                                        </div>

                                        <hr class="py-2" />

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <Input
                                                    v-model="form.first_name"
                                                    class="form-control"
                                                    id="first_name"
                                                    placeholder="Enter your first name"
                                                    :error="
                                                        form.errors.first_name
                                                    "
                                                />
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <Input
                                                    v-model="form.last_name"
                                                    class="form-control"
                                                    id="first_name"
                                                    placeholder="Enter your last name"
                                                    :error="
                                                        form.errors.last_name
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div
                                            class="d-md-flex justify-content-start align-items-center mb-4 py-2"
                                        >
                                            <h6 class="mb-0 me-4">Gender:</h6>
                                            <Radio
                                                v-model="form.gender"
                                                :options="gender"
                                                class="mb-0 me-4"
                                                :error="form.errors.gender"
                                            />
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <Select
                                                    v-model="form.civil_status"
                                                    :options="civilStatus"
                                                    :error="
                                                        form.errors.civil_status
                                                    "
                                                    default-label="Select Civil Status"
                                                />
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <Input
                                                    v-model="form.mobile_number"
                                                    class="form-control"
                                                    id="first_name"
                                                    placeholder="Enter your cellphone no."
                                                    :error="
                                                        form.errors
                                                            .mobile_number
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <Select
                                                    v-model="form.block"
                                                    :options="blkNum"
                                                    :error="form.errors.block"
                                                    default-label="Select Block"
                                                />
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <Select
                                                    v-model="form.lot"
                                                    :options="lotNum"
                                                    :error="form.errors.lot"
                                                    default-label="Select Lot"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label
                                                class="form-label"
                                                for="birthdate"
                                                >Birthday:</label
                                            >
                                            <Input
                                                v-model="form.birthdate"
                                                id="birthdate"
                                                type="date"
                                                class="form-control"
                                                placeholder="Enter your birthdate"
                                            />
                                        </div>

                                        <div
                                            class="d-flex justify-content-end pt-3"
                                        >
                                            <ButtonPrimary
                                                :disabled="form.processing"
                                            >
                                                <spring-spinner
                                                    v-if="form.processing"
                                                    :animation-duration="3000"
                                                    :size="20"
                                                    color="#fff"
                                                />
                                                <span v-else>Register</span>
                                            </ButtonPrimary>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer :show-top-details="false" />
    </section>
</template>

<style scoped>
section {
    padding-top: 3rem !important;
    padding-bottom: 0 !important;
}

img {
    border-top-left-radius: 0.25rem;
    border-bottom-left-radius: 0.25rem;
    margin: auto;
    display: block;
    padding-top: 20%;
}
</style>
