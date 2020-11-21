<template>
    <div>
        ========== Normal ==========
        <p>Gía trị của A: {{ a }}</p>
        <p>Gía trị của B: {{ b }}</p>

        <button @click="a++">Tăng A</button>
        <button @click="b++">Tăng B</button>

        <br><br>
        ========== Computed ==========
        <br><br>


        <input type="text" v-model="lowerCase">
        <p>To uppercase: <strong>{{uppercase}}</strong></p>

        <br><br>
        ========== Computed ==========
        <br><br>

        <input type = "text" v-model = "kilometers" placeholder="Enter kilomet">
        <input type = "text" v-model = "meters" placeholder="Enter met">

    </div>
</template>

<style>

</style>

<script>
    export default {
        data() {
            return {
                a: 0,
                b: 0,
                lowerCase: '',
                kilometers: '',
                meters: '',
            }
        },
        computed: {
            uppercase() {
                return this.lowerCase.toUpperCase();
            },
        },
        watch: {
            kilometers(val) {
                console.log('Ban enter kilometers')
                this.kilometers = val
                this.meters = val*1000
            },
            meters(val) {
                console.log('Ban enter meters')
                this.meters = val
                this.kilometers = val/1000
            }
        },
        methods: {

        }
    }
</script>
