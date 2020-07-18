<template>
    <section class="breadcrumb-section set-bg" :data-setbg="'/img/breadcrumb.jpg'">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 v-text="title"></h2>
                        <div class="breadcrumb__option">
                            <router-link :to="{name:'home'}">Inicio</router-link>
                            <span v-text="breadcrumb"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Breadcrumb",
        props: ["title", "breadcrumb"],
    }
</script>

<style scoped>

</style>
