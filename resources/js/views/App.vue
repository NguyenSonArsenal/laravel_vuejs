<style></style>

<template>
    <div id="wrapper">
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
            return {};
        },
        methods : {

        },
        computed : {

        },
        ready : function(){

        }
    }
</script>
