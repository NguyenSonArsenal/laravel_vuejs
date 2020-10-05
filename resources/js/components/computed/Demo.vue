<template>
    <div>
        <p>Gía trị của A: {{ a }}</p>
        <p>Gía trị của B: {{ b }}</p>

        <button @click="a++">Tăng A</button>
        <button @click="b++">Tăng B</button>
    </div>
</template>

<style>

</style>

<script>
    export default {
        data() {
            return {
                a: 0,
                b: 0
            }
        },
        computed: {

        },
        methods: {

        }
    }
</script>