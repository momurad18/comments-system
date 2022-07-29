<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm px-2">
        <router-link :to="{ name: 'home' }" class="navbar-brand"
            >Comment Sytem</router-link
        >
        <button
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#navbarCollapse"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link
                        class="nav-link"
                        data-toggle="collapse"
                        :to="{ name: 'post', params: { id: 1 } }"
                    >
                        Single Post
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Header",
};
</script>

<style></style>
