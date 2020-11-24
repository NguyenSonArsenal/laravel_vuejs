<style></style>

<template>
    <div>
        <div class="error alert alert-danger" v-if="errorsValidate.length > 0">
            <ul class="mb-0">
                <li v-for="error in errorsValidate">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['errorsValidate'],
    }
</script>
