<template>
	<div class="container">
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						Add new book
					</div>
					<div class="card-body">
						<form @submit.prevent="add()">
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" placeholder="Enter title" v-model="book.title">
							</div>
							<div class="form-group">
								<label for="author">Author</label>
								<input type="text" class="form-control" id="author" placeholder="Enter Author" v-model="book.author">
							</div>
							<div class="form-group">
								<label for="title">Description</label>
								<textarea class="form-control" placeholder="Enter Description" rows="3" v-model="book.description">

								</textarea>
							</div>
							<div class="form-group">
								<label for="link">Link</label>
								<input type="text" class="form-control" id="link" placeholder="Enter Link" v-model="book.link">
							</div>

							<div class="form-group">
								<label for="category">Category</label>
								<ApolloQuery :query="require('../graphql/queries/categories.gql')">
							        <!-- The result will automatically updated -->
							        <template v-slot="{ result: { error, data }, isLoading }">
							          <!-- Some content -->
							                <div v-if="isLoading">Loading...</div>

							                <select v-else-if="data"  class="form-control" v-model="book.category">
												<option v-for="category in data.categories" :value="category.id">
													{{ category.name}}
												</option>
											</select>
							                <div v-else class="no-result apollo">No result :(</div>
							        </template>
							  </ApolloQuery>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox"  id="featured" value="1" v-model="book.featured">
								<label class="form-check-label" for="featured">Featured</label>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</div>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>


</template>




<script>
    import addBookQuery from '../graphql/mutations/addBook.gql'

    export default	{
        data() {
            return {
                book: {
                    title: "",
                    author: "",
                    image: "",
                    description: "",
                    link: "",
                    featured: false,
                    category: 0
                }
            }
        },

        methods: {

            add(){
            this.$apollo.mutate({
                mutation: addBookQuery,
                variables: {
                    title: this.book.title,
                    author: this.book.author,
                    image: this.book.image,
                    description: this.book.description,
                    link: this.book.link,
                    featured: this.book.featured,
                    category: this.book.category
                }

            }).then((data) => {
                this.book.title= "",
                this.book.author= "",
                this.book.description= "",
                this.book.image= "",
                this.book.link= "",
                this.book.featured= false,
                this.book.category= 0
            }).catch((error) => {
                let { graphQLErrors } = error;

                console.log(graphQLErrors)

                if (graphQLErrors[0].extensions.category === "validation") {
                    validationErrors = graphQLErrors[0].extensions.validation;

                    console.log(validationErrors);
                }
            })
        }
        }
    }
</script>
