<template>
    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <categories v-on:category-id-changed="updateBooksListBy"></categories>
                </div>
            </div>
             <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        Books
                        <div class="text-center">
                            <router-link to="/book/add"> Create New Book</router-link>
                        </div>
                    </div>
                    <div class="card-body">
                        <books  :category="selectedCategory" :query="query"></books>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Categories from "./categories";
    import Books from "./books";
    import booksQuery from '../graphql/queries/books.gql'
    import booksFeaturedQuery from '../graphql/queries/booksFeatured.gql'
    import CategoryQuery from '../graphql/queries/category.gql'

    export default {
        name: "home",
        components: {
            Categories, 
            Books,
        },
        data(){
            return {
                query: booksQuery,
                booksQuery,
                booksFeaturedQuery,
                CategoryQuery,
                selectedCategory: 'all'
            }
        },

        methods: {
            updateBooksListBy(type){
                if(type === 'all') {
                    this.query = this.booksQuery;
                }else if(type === 'featured'){
                    this.query = this.booksFeaturedQuery;
                }else{
                    this.query = this.CategoryQuery;
                }
                this.selectedCategory = type;
            }
        }
    }
</script>
