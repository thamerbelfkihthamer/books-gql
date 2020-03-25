<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Books</div>
                    <div class="card-body">
                        <categories></categories>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Categories from "./categories";
    export default {
        name: "home",
        components: {Categories}
    }
</script>
