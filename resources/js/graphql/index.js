import Vue from 'vue'
import VueApollo from 'vue-apollo'
import ApolloClient from 'apollo-boost'


const apolloClient = new ApolloClient({
    // You should use an absolute URL here
    uri: 'http://www.books-ql.com/graphql'
})


Vue.use(VueApollo)

const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
})

export default apolloProvider
