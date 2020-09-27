<style></style>

<template>
    <div>
        <div class="footer">
            <div>
                Bản quyền dev.banhang.jp thuộc về <span v-html="link"></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'comp-footer',
        data: function () {
            return {
                link:  '<a href="https://www.facebook.com/nguyen.son.9615">NguyenSonArsenal</a>'
            }
        }
    }
</script>


