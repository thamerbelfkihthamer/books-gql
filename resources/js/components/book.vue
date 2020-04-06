<template>
    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">Book</span>
                        <span class="float-right btn btn-outline-primary" @click="edit">Edit Book</span>
                        <span class="float-right btn btn-outline-secondary" @click="remove">Delete Book</span>
                    </div>
                    <div class="card-body">
                        <ApolloQuery :query="query" :variables="{ id: id}">
                            <template v-slot="{ result: { error, data }, isLoading }">
                                    <div v-if="isLoading">Loading...</div>
                                    <div v-else-if="error" class="error apollo">An error occurred</div>
                                    <div  v-else-if="data.book !== null">
                                        <h5 class="card-title">Title: {{ data.book.title }}</h5>
                                        <h5 class="card-title">Author: {{ data.book.author }}</h5>
                                        <p class="card-text">
                                             {{ data.book.description}}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                Last updated 3 mins ago
                                            </small>
                                        </p>
                                    </div>
                                    <div v-else class="no-result apollo">No result :(</div>
                            </template>
                        </ApolloQuery>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BookQuery from '../graphql/queries/book.gql'
    import DeleteBookQuery from '../graphql/mutations/deleteBook.gql'

    export default {
        name: "book",
        props: ['id'],
        data(){
            return{
                query: BookQuery,
            }
        },

        methods: {
            remove(){
                this.$apollo.mutate({
                    mutation:DeleteBookQuery,
                    variables: {
                        id: this.id,
                    }
                    }).then((data) => {
                        this.$router.push({name: 'home'});
                }).catch((error) => {
                    console.error(error)
                })
              },

            edit(){
                // show modal with data to update
            }
        }
    }
</script>
