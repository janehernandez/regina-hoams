<script setup>
import { toRefs } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({ showTopDetails: Boolean });
const { showTopDetails } = toRefs(props);
</script>

<template>
    <footer
        v-if="showTopDetails"
        id="footer"
        data-aos="fade-up"
        data-aos-easing="ease-in-out"
        data-aos-duration="500"
    >
        <!-- <div class="footer-newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div> -->

                    <div class="col-lg-6 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                            Brgy. Inocencio, <br />
                            Trece Martires City Cavite<br /><br />
                            <strong>Phone:</strong> 09564993543<br />
                            <strong>Email:</strong>
                            regina.ville2kofs@gmail.com<br />
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-6 footer-info">
                        <h3>About Regina Ville HOA</h3>
                        <p>
                            Cras fermentum odio eu feugiat lide par naso tierra.
                            Justo eget nada terra videa magna derita valies
                            darta donna mare fermentum iaculis eu non diam
                            phasellus.
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"
                                ><i class="bx bxl-twitter"></i
                            ></a>
                            <a href="#" class="facebook"
                                ><i class="bx bxl-facebook"></i
                            ></a>
                            <a href="#" class="instagram"
                                ><i class="bx bxl-instagram"></i
                            ></a>
                            <a href="#" class="linkedin"
                                ><i class="bx bxl-linkedin"></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright
                <strong><span>Regina Ville 2000 HOA</span></strong
                >. All Rights Reserved
            </div>
        </div>
    </footer>

    <footer v-else id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright
                <strong><span>Regina Ville 2000 HOA</span></strong
                >. All Rights Reserved
            </div>
        </div>
    </footer>
</template>
