<template>
    <!-- ============================ Footer Start ================================== -->
    <footer class="theme-footer">
        <div>
            <v-container fluid >
                <v-row>


                    <v-col cols="12" sm="6" md="6" >
                        <div class="footer-widget text-center-sm pa-2">
                            <h2 class="widget-title mt-3 text-h2">Contact Us</h2>
                            <ul class="ml-8">
                                <li class="footer-link"><a href="#">69 Samora Machel Ave, Harare</a></li>
                                <li class="footer-link"><a href="mailto:info@capitalkreatives.com">info@capitalkreatives.com</a></li>
                                <li class="footer-link"><a href="tel:+263782893151">+263 782 893 151</a></li>
                            </ul>

                            <div class="d-flex pl-4 my-5">
                                <a target="_blank" href="https://www.instagram.com/ckreativeszw/" class="mx-3">
                                    <img height="45" src="/images/instagram.png" alt="">
                                </a>
                                <a target="_blank" href="https://www.facebook.com/ckreativeszw/" class="mx-3">
                                    <img height="40" src="/images/FB-LOGO-CREAM.png" alt="">
                                </a>
                                <a target="_blank" href="https://twitter.com/ckreativeszw" class="mx-3">
                                    <img height="40" src="/images/X-LOGO-CREAM.png" alt="">
                                </a>
                                <a target="_blank" href="https://www.linkedin.com/company/ckreatives" class="mx-3">
                                    <img height="40" src="/images/LINKEDIN-LOGO-CREAM.png" alt="">
                                </a>
                            </div>
                        </div>
                    </v-col>

                </v-row>
            </v-container>
        </div>

        <div class="footer-bottom mb-2 ">
        </div>
    </footer>


    <!-- ============================ Footer End ================================== -->
</template>

<script>

export default {
    name: "FooterBar"
}
</script>

<style scoped>


.copyright-social ul li{
    font-size: 16px !important;
}

.footer-bottom{
    background-image: url("/images/footer.png");
    height: 50px !important;
    background-repeat: no-repeat;
    width: 100%;
    background-origin: content-box;
    background-position: center center;

}
.theme-footer{
    background: #141414;
    color:white !important;
}

.widget-title {
    color:white !important;
}

.footer-widget a{
    color:white !important;
}

.footer-bottom-social a{
    text-decoration: none !important;
    color:white !important;
}

.footer-bottom-social li {
    list-style: none !important;
}

.social-button{
    padding-left: 20px !important;
    font-size: 30px;
}

.copyright-social ul li {
    display: inline-block;
    margin-right: 10px;
}
.copyright-social a {
    text-decoration: none;
    color: white !important;
}
.footer-widget a {
    text-decoration: none;
    color: white !important;
}

.footer-widget li {
    text-decoration: none;
    color: white !important;
    padding-bottom: 5px !important;
}

.widget-title {
    /*border-bottom: 1px solid #eee;*/
    padding-bottom: 10px;
    margin-bottom: 20px;
    position: relative;
    font-size: 24px;
}

.widget-title {
    position: relative; /* Ensure pseudo-elements are positioned relative to this element */
}

.widget-title:after {
    content: "";
    position: absolute;
    background: #ffffff; /* White line */
    bottom: -6px; /* Adjusted to leave space for the yellow line */
    left: 0;
    width: 50px;
    height: 5px;
}

.widget-title:before {
    content: "";
    position: absolute;
    background: #F7C54A; /* Yellow line */
    bottom: -4px;
    left: 0;
    width: 100%;
    height: 2px;
}


.footer-link   {
    color: #fff !important;
}

.footer-link a  {
    position: relative;
    text-decoration: none;
    color: #fff !important;
    font-size: 20px !important;
}

.footer-link a::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    border-radius: 3px;
    background-color: #d1d1d1;
    bottom: 0;
    left: 0;
    transform-origin: right;
    transform: scaleX(0);
    transition: transform .3s ease-in-out;
}

.footer-link a:hover::before {
    transform-origin: left;
    transform: scaleX(1);
}
</style>
