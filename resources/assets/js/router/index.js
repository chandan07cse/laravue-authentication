import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Products from '../views/Products.vue'
import Store from '../views/Store.vue'
import Register from '../views/Auth/Register.vue'
import Login from '../views/Auth/Login.vue'
import AdminDashboard from '../views/admin/Dashboard.vue'
import AdminCategory from '../views/admin/Category.vue'
import AdminProduct from '../views/admin/Products.vue'
import NotFound from '../views/NotFound.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    fallback: true, //router should fallback to hash (#) mode when the browser does not support history.pushState
    routes:[
        { path: '*', component: NotFound },
        { path:'/',component:Home },
        { path:'/about',component:About },
        { path:'/products',component:Products },
        { path:'/store',component:Store },
        { path:'/registration',component:Register },
        { path:'/login',component:Login },
        { path:'/admin/dashboard',component:AdminDashboard },
        { path:'/admin/categories',component:AdminCategory },
        { path:'/admin/products',component:AdminProduct }
    ]
});

export default router