<template>          
    <ApolloQuery :query="require('../graphql/queries/categories.gql')">
        <!-- The result will automatically updated -->
        <template v-slot="{ result: { error, data }, isLoading }">
          <!-- Some content -->
                <div v-if="isLoading">Loading...</div>

                <div v-else-if="error" class="error apollo">An error occurred</div>
                <ul v-else-if="data" class="list-group list-group-flush">
                    <a href="#" class="list-group-item" @click.prevent="$emit('category-id-changed', 'all')">All</a>
                    <a href="#" class="list-group-item" @click.prevent="$emit('category-id-changed', 'featured')">Featured</a>
                    <a href="#" v-for="category of data.categories" class="list-group-item" :key="category.id" @click.prevent="$emit('category-id-changed', category.id)">
                        {{ category.name }}
                    </a>
                </ul>
                <div v-else class="no-result apollo">No result :(</div>
        </template>
  </ApolloQuery>
</template>

<script>
    export default {
        name: "categories",
    }
</script>
