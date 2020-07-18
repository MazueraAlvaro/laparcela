<template>

</template>

<script>
    export default {
        name: "Home",
        created() {
            jQuery('.set-bg').each(function () {
                var bg = jQuery(this).data('setbg');
                jQuery(this).css('background-image', 'url(' + bg + ')');
            });
        }
    }
</script>

<style scoped>

</style>
