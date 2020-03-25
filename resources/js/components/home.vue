<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <router-link to="/about">About</router-link>
                <router-link to="/home">Home</router-link>
                <router-view></router-view>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <categories></categories>
                </div>
            </div>
             <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Books</div>
                    <div class="card-body">
                        <books></books>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Categories from "./categories";
    import Books from "./books";
    export default {
        name: "home",
        components: {
            Categories, 
            Books
        }
    }
</script>
