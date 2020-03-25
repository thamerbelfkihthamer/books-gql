<template>

    <div v-if="category==='all'">
        <ApolloQuery :query="query">
            <!-- The result will automatically updated -->
            <template v-slot="{ result: { error, data }, isLoading }">
              <!-- Some content -->
                    <div v-if="isLoading">Loading...</div>

                    <div v-else-if="error" class="error apollo">An error occurred</div>
                    <ul v-else-if="data.books.length > 0" class="list-group list-group-flush">
                        <li v-for="book of data.books" class="list-group-item" :key="book.id">
                            {{ book.author }}
                        </li>
                    </ul>
                    <div v-else class="no-result apollo">No result :(</div>
            </template>
        </ApolloQuery>
    </div>

     <div v-else-if="category==='featured'">
        <ApolloQuery :query="query" :variables="{ featured: true}">
            <!-- The result will automatically updated -->
            <template v-slot="{ result: { error, data }, isLoading }">
              <!-- Some content -->
                    <div v-if="isLoading">Loading...</div>

                    <div v-else-if="error" class="error apollo">An error occurred</div>
                    <ul v-else-if="data.booksByFeatured.length > 0" class="list-group list-group-flush">
                        <li v-for="book of data.booksByFeatured" class="list-group-item" :key="book.id">
                            {{ book.author }}
                        </li>
                    </ul>
                    <div v-else class="no-result apollo">No result :(</div>
            </template>
        </ApolloQuery>
    </div>


     <div v-else>
        <ApolloQuery :query="query" :variables="{ id: category}">
            <!-- The result will automatically updated -->
            <template v-slot="{ result: { error, data }, isLoading }">
              <!-- Some content -->
              {{ data.category.name }}
                    <div v-if="isLoading">Loading...</div>

                    <div v-else-if="error" class="error apollo">An error occurred</div>
                    <ul v-else-if="data.category.books.length > 0" class="list-group list-group-flush">
                        <li v-for="book of data.category.books" class="list-group-item" :key="book.id">
                            {{ book.author }}
                        </li>
                    </ul>
                    <div v-else class="no-result apollo">No result :(</div>
            </template>
        </ApolloQuery>
    </div>

</template>

<script>
    export default {
        name: "books",
        props: ['category', 'query'],
        data(){
            return{
            
            }
        },
    }
</script>
