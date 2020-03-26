<template>          
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <router-link to="/home">Home</router-link>
                        <router-link to="/about">about</router-link>
                    </div>
                </div>
            </div>
        </div>
         <router-view></router-view>
    </div>
</template>
<script>
    import Home from "./home";
    export default {
        name: "App",
        components: {
            Home
        },

    }
</script>
<style>
    a.router-link-active {
      color: #f66;
    }
</style>
