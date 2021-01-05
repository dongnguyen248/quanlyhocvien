<template>
    <div id="main">
        <Header></Header>
        <sidebar></sidebar>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Header from "./Header";
import sidebar from "./Sidebar";

export default {
    name: "main-app",
    components: {
        Header,
        sidebar
        
    }
};
</script>
