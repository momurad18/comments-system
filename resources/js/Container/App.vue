<template>
    <Wrapper>
        <Header />
        <div class="container py-4 min-vh-100">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <router-view></router-view>
                </div>
                <div
                    class="col-lg-3 d-lg-flex d-none justify-content-center align-items-center"
                    style="background-color: rgb(247, 247, 247)"
                ></div>
            </div>
        </div>
        <Footer />
    </Wrapper>
</template>

<script>
import Wrapper from "../Components/Template/Wrapper/Wrapper.vue";
import Header from "../Components/Template/Header/Header.vue";
import Footer from "../Components/Template/Footer/Footer.vue";

export default {
    name: "App",
    components: { Wrapper, Header, Footer },
};
</script>

<style></style>
