<style></style>

<template>

    <router-view v-if="isFrontendArea"></router-view>  <!-- FRONTEND AREA -->

    <div v-else-if="isBackEndLoginPage" style="height: 100%; background: #f3f3f4">
        <router-view></router-view> <!-- BACKEND LOGIN -->
    </div>

    <div id="wrapper" v-else="isBackendArea">  <!-- BACKEND AREA -->
        <Navbar />
        <div id="page-wrapper" class="gray-bg">
            <HeaderTop />
            <router-view></router-view>
            <Footer />
        </div>
    </div>
</template>

<script>
    import Navbar from './backend/layouts/Navbar.vue';
    import HeaderTop from './backend/layouts/HeaderTop.vue';
    import Footer from './backend/layouts/Footer.vue';

    export default {
        // name: 'app',
        components: {
            'HeaderTop': HeaderTop,
            'Footer': Footer,
            'Navbar': Navbar
        },

        data() {
            return {
                routeName: null,
                isBackEndLoginPage: false,
                isFrontendArea: false,
                isBackendArea: false,
            };
        },

        watch: {
            '$route': 'currentRoute',
            routeName() {
                this.isBackEndLoginPage = this.routeName.toLowerCase() == 'login'

                if (!this.$router.currentRoute.path.includes("management")) {
                    this.isFrontendArea = true
                } else {
                    this.isBackendArea = true;
                }
            }
        },

        methods: {
            currentRoute() {
                this.$nextTick(() => {
                    this.routeName = this.$route.name
                });
            }
        },
    }
</script>
