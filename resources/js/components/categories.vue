<template>
    <div class="container">
        <div class="col-4">
            <ul>
                <li v-for="(item, index) in categories"> {{ item.name }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    import gql from 'graphql-tag'

    export default {
        name: "categories",
        data(){
            return{
                categories: []
            }
        },

        apollo: {
            categories: gql`{
                categories {
                    id
                    name
                }
            }`,
        },

    }
</script>
