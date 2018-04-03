import Vue from 'vue'
import VueRouter from 'vue-router'
import Guard from '../middleware'

import Home from '../views/public/Home.vue'
import About from '../views/public/About.vue'
import Contact from '../views/public/Contact.vue'

import Register from '../views/public/auth/Register.vue'
import Login from '../views/public/auth/Login.vue'
import RegisterConfirm from '../views/public/auth/RegisterConfirm.vue'
import ForgetPassword from '../views/public/auth/ForgetPass.vue'
import ResetPassword from '../views/public/auth/ResetPass.vue'

import AdminDashboard from '../views/admin/Dashboard.vue'
import AdminCategory from '../views/admin/Category.vue'
import AdminPosts from '../views/admin/Posts.vue'
import DeleteUser from '../views/admin/DeleteUser.vue'

import NotFound from '../views/NotFound.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    fallback: true, //router should fallback to hash (#) mode when the browser does not support history.pushState
    linkExactActiveClass: "active", // active class for *exact* links.
    routes:[
        /*public routes*/
        { path: '*', component: NotFound },
        { path:'/',component:Home },
        { path:'/about',component:About },
        { path:'/contact',component:Contact },
        /*auth routes*/
        { path:'/registration',component:Register },
        { path:'/register/confirm/:activation_token',component:RegisterConfirm },
        { path:'/login',component:Login },
        { path:'/forget_pass',component:ForgetPassword },
        { path:'/reset/pass/:token',component:ResetPassword },
        /*admin routes*/
        { path:'/admin/dashboard',component:AdminDashboard,beforeEnter: Guard.auth },
        { path:'/admin/categories',component:AdminCategory,beforeEnter: Guard.auth },
        { path:'/admin/posts',component:AdminPosts,beforeEnter: Guard.auth },
        { path:'/delete/user/:id',component:DeleteUser }
    ]
});

export default router