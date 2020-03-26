<template>

    <div>
        <div v-if="category==='all'">
            <ApolloQuery :query="query">
                <!-- The result will automatically updated -->
                <template v-slot="{ result: { error, data }, isLoading }">
                  <!-- Some content -->
                        <div v-if="isLoading">Loading...</div>

                        <div v-else-if="error" class="error apollo">An error occurred</div>
                        <div  v-else-if="data.books">
                            <router-link :to="`/books/${book.id}`" v-for="book of data.books" :key="book.id">
                                    {{ book.author }}
                                    <br>
                            </router-link>
                        </div>
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
                        <div  v-else-if="data.booksByFeatured">
                            <router-link :to="`/books/${book.id}`" v-for="book of data.booksByFeatured" :key="book.id">
                                    {{ book.author }}
                                    <br>
                            </router-link>
                        </div>
                        <div v-else class="no-result apollo">No result :(</div>
                </template>
            </ApolloQuery>
        </div>


         <div v-else>
            <ApolloQuery :query="query" :variables="{ id: category}">
                <!-- The result will automatically updated -->
                <template v-slot="{ result: { error, data }, isLoading }">
                  <!-- Some content -->
                        <div v-if="isLoading">Loading...</div>
                        <div v-else-if="error" class="error apollo">An error occurred</div>
                        <div  v-else-if="data.category">
                            <router-link :to="`/books/${book.id}`" v-for="book of data.category.books" :key="book.id">
                                    {{ book.author }}
                                    <br>
                            </router-link>
                        </div>
                        <div v-else class="no-result apollo">No result :(</div>
                </template>
            </ApolloQuery>
        </div>
    </div>
</template>

<script>
    export default {
        name: "books",
        props: ['category', 'query'],
    }
</script>
