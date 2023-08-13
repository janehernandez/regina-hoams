<script setup>
import { ref, onMounted, toRefs } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    stopScroll: Boolean,
    active: String,
    showNavbar: Boolean,
    isAdmin: Boolean,
});
const { stopScroll, active, showNavbar, isAdmin } = toRefs(props);

const header = ref(null);
const navbar = ref(null);
const isDrawerOpen = ref(false);

onMounted(() => {
    if (!stopScroll.value) {
        let offset = header.value.offsetHeight;

        if (!header.value.classList.contains("header-scrolled")) {
            offset -= 20;
        }

        let elementPos = header.value.offsetTop;
        window.scrollTo({
            top: elementPos - offset,
            behavior: "smooth",
        });

        const headerScrolled = () => {
            if (window.scrollY > 100) {
                header.value.classList.add("header-scrolled");
            } else {
                if (header.value.classList.contains("header-scrolled")) {
                    header.value.classList.remove("header-scrolled");
                }
            }
        };
        window.addEventListener("load", headerScrolled);
        window.addEventListener("scroll", headerScrolled);
    }
});

const isActive = (currentPageClicked) => {
    return currentPageClicked === active.value;
};

const openDrawer = () => {
    navbar.value.classList.toggle("navbar-mobile");
    isDrawerOpen.value = !isDrawerOpen.value;
};

const adminHeaderLabel = () => {
    return `Regina HOA ${isAdmin.value ? "Admin" : ""}`;
};
</script>

<template>
    <header
        id="header"
        ref="header"
        class="fixed-top d-flex align-items-center"
        :class="
            ({ 'header-fix': stopScroll },
            { 'header-transparent': !isAdmin && isActive('home') })
        "
    >
        <div
            class="container d-flex justify-content-between align-items-center"
        >
            <div class="logo">
                <h1 class="text-light">
                    <Link :href="route('home')"
                        ><span>{{ adminHeaderLabel() }} </span></Link
                    >
                </h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav v-if="showNavbar" id="navbar" ref="navbar" class="navbar">
                <ul v-if="!isAdmin">
                    <li>
                        <Link
                            :class="{ active: isActive('home') }"
                            :href="route('home')"
                            >Home</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/calendar"
                            :class="{ active: isActive('calendar') }"
                            >Calendar</Link
                        >
                    </li>
                    <li>
                        <Link
                            v-if="usePage().props.auth.user"
                            href="/logout"
                            method="post"
                            >Logout</Link
                        >

                        <Link
                            v-else
                            :href="route('login.index')"
                            :class="{ active: isActive('login') }"
                            >Login</Link
                        >
                    </li>
                </ul>
                <ul v-else>
                    <li>
                        <Link
                            :class="{ active: isActive('announcement') }"
                            :href="route('admin.announcements.index')"
                            >Announcements</Link
                        >
                    </li>
                    <li>
                        <Link
                            :class="{ active: isActive('appointment') }"
                            :href="route('admin.appointments.index')"
                            >Appointments</Link
                        >
                    </li>
                    <li>
                        <Link
                            :class="{ active: isActive('homeowners') }"
                            :href="route('admin.homeowners')"
                            >Homeowners</Link
                        >
                    </li>
                    <li>
                        <Link
                            :class="{ active: isActive('officers') }"
                            :href="route('admin.officers.index')"
                            >Officers</Link
                        >
                    </li>
                    <li>
                        <Link
                            v-if="usePage().props.auth.user"
                            href="/logout"
                            method="post"
                            >Logout</Link
                        >

                        <Link
                            v-else
                            :href="route('login.index')"
                            :class="{ active: isActive('login') }"
                            >Login</Link
                        >
                    </li>
                </ul>
                <i
                    ref="mobileNavToggle"
                    class="bi mobile-nav-toggle"
                    :class="[isDrawerOpen ? 'bi-x' : 'bi-list']"
                    @click="openDrawer"
                ></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->
</template>
