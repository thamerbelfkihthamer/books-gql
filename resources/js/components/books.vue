<template>
    <ApolloQuery :query="require('../graphql/queries/books.gql')">
    <!-- The result will automatically updated -->
    <template v-slot="{ result: { error, data }, isLoading }">
      <!-- Some content -->
            <div v-if="isLoading">Loading...</div>

            <div v-else-if="error" class="error apollo">An error occurred</div>
            <ul v-else-if="data">
                <li v-for="book of data.books" class="user" :key="book.id">
                    {{ book.id }}. {{ book.title }}
                </li>
            </ul>
            <div v-else class="no-result apollo">No result :(</div>
    </template>
  </ApolloQuery>
</template>

<script>
    export default {
        name: "books",
        data(){
            return{
            
            }
        },
    }
</script>
