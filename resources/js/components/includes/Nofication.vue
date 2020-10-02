<style></style>

<template>
    <div>
        <div v-if="notification" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ notification }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

</template>

<script>
    export default {
        // name: 'notification',
        props: ['notification'],
        created: function () {
            // console.log('notification message from parent component');
            // console.log(this.notification) //prints out an empty string
        },
    }
</script>


