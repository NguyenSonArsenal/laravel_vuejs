<style></style>

<template>
    <div id="wrapper">
        <Navbar />

        <div id="page-wrapper" class="gray-bg">
            <HeaderTop />
            <router-view></router-view> <!-- Content -->
            <Footer />
        </div>

        <!--<Modal />--> <!-- @todo -->
    </div>
</template>

<script>
    import Navbar from './layouts/Navbar.vue';
    import HeaderTop from './layouts/HeaderTop.vue';
    import Footer from './layouts/Footer.vue';

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
