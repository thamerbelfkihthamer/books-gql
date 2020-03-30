import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import About from '../components/about'
import Home from '../components/home'
import Book from '../components/book'
import NotFound from '../components/notFound'
import addBook from '../components/addBook'

// 2. Define  routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
	{ 
  		path: '/home',
  		component: Home,
 	},
  	{	 
  		path: '/about',
   		component: About
   	},
   	{
   		path: '/books/:id',
  		component: Book,
  		props: true
   	},
    {
   		path: '/book/add',
  		component: addBook,
   	},
   	{
   		path: '*',
   		component: NotFound,
   	}

]


// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
	//mode: 'history', // this give us a problem so we should fix it with this : https://router.vuejs.org/guide/essentials/history-mode.html#example-server-configurations
  	routes // short for `routes: routes`
})

export default router