<style></style>

<template>
    <div id="wrapper" v-if="!isBackEndLoginPage">
        <Navbar />
        <div id="page-wrapper" class="gray-bg">
            <HeaderTop />
            <router-view></router-view>
            <Footer />
        </div>
    </div>
    <div v-else>
        <router-view></router-view>
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
                isBackEndLoginPage: false
            };
        },

        watch: {
            '$route': 'currentRoute',
            routeName() {
                this.isBackEndLoginPage = this.routeName.toLowerCase() == 'login'
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
