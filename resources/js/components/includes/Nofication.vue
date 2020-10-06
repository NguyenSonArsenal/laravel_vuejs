<style></style>

<template>
    <div>
        <div v-if="notificationX" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ notificationX }}</strong>
            <button type="button" @click="onClose">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['propNotification'],
        computed: {
            notificationX: function() {
                return this.propNotification;
            },
        },
        methods: {
            onClose: function () {
                this.$emit('emitOnClose');
            }
        }
    }
</script>


