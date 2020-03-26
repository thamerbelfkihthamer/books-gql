<template>          
    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Book</div>
                    <div class="card-body">
                        <ApolloQuery :query="query" :variables="{ id: id}">
                            <!-- The result will automatically updated -->
                            <template v-slot="{ result: { error, data }, isLoading }">
                              <!-- Some content -->
                                    <div v-if="isLoading">Loading...</div>

                                    <div v-else-if="error" class="error apollo">An error occurred</div>
                                    
                                    <div  v-else-if="data.book !== null">
                                        {{ data.book.id}} / {{ data.book.title }} / {{ data.book.author }}
                                        <br>
                                        {{ data. book.description }}

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

    export default {
        name: "book",
        props: ['id'],
        data(){
            return{
                query: BookQuery,
            }
        }
    }
</script>