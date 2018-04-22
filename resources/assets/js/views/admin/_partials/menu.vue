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
                    <ul class="nav navbar-nav">
                        <li><router-link to="/admin/dashboard">Dashboard</router-link></li>
                        <li><router-link to="/admin/categories">Categories</router-link></li>
                        <li><router-link to="/admin/posts">Posts</router-link></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a @click.stop="logout" >Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
import Auth from '../../../store/auth'
import { post } from '../../../helpers/api'
export default{
    methods:{
        logout(){
            post('/api/logout')
                .then((response)=>{
                    console.log(response)
                    if(response.data.logged_out){
                        Auth.remove()
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
    .active{
        color: #fff !important;
        background: rgb(53, 73, 94) !important;
        border-left-color: #3c8dbc !important;
    }
</style>