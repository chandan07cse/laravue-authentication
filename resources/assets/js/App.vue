<template>
    <div>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav" v-if="!check">
                        <li><router-link to="/">Home</router-link></li>
                        <li><router-link to="/about">About</router-link></li>
                        <li><router-link to="/products">Products</router-link></li>
                        <li><router-link to="/store">Store</router-link></li>
                    </ul>
                    <ul class="nav navbar-nav" v-else>
                        <li><router-link to="/admin/dashboard">Dashboard</router-link></li>
                        <li><router-link to="/admin/categories">Categories</router-link></li>
                        <li><router-link to="/admin/products">Products</router-link></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li v-if="!check"><router-link to="/registration">Signup</router-link></li>
                        <li v-if="!check"><router-link to="/login">Login</router-link></li>
                        <li v-if="check"><a @click.stop="logout" >Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="flash flash__success text-center" v-if="flash.success">
            {{flash.success}}
        </div>
        <div class="flash flash__error" v-if="flash.error">
            {{flash.error}}
        </div>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Auth from './store/auth'
    import Flash from './helpers/flash'
    import { post } from './helpers/api'
    export default{
        created(){
            Auth.initialize()
        },
        data(){
            return {
                auth: Auth.state,
                flash: Flash.state
            }
        },
        computed:{
            check(){
                return !!(this.auth.api_token && this.auth.user_id)
            }
        },
        methods:{
            logout(){
               post('/api/logout')
                   .then((response)=>{
                    console.log(response)
                        if(response.data.logged_out){
                            Auth.remove()
                            Flash.setSuccess('Logged Out Successfully')
                            this.$router.push('/login')
                        }
                   })
                   .catch((errors)=>{

                   })
            }
        }
    }
</script>
<style>
    .navbar{
        background-color: rgb(65, 184, 131);
    }
    .navbar-default .navbar-nav > li > a {
        color: #fff;
    }
    .container{
        margin-top:10px;
    }
</style>