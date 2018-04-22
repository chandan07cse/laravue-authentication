<template>
    <div>
        <menu-section></menu-section>
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><router-link to="/forget_pass">Forgot password?</router-link></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form  class="form-horizontal" role="form" method="POST" @submit.prevent="login">
                    <div style="margin-bottom: 25px;">
                        <div class="input-group" :class="{'has-error':this.error.email}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" placeholder="Your Email Please" v-model="form.email">
                        </div>
                            <small class="has-error" v-if="error.email">{{error.email[0]}}</small>
                    </div>
                    <div style="margin-bottom: 25px;">
                        <div class="input-group" :class="{'has-error':this.error.password}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Your Password Please" v-model="form.password">
                        </div>
                        <small class="has-error" v-if="error.password">{{error.password[0]}}</small>
                    </div>
                    <!--<div class="input-group">-->
                        <!--<div class="checkbox">-->
                            <!--<label>-->
                                <!--<input id="login-remember" type="checkbox" name="remember" value="1"> Remember me-->
                            <!--</label>-->
                        <!--</div>-->
                    <!--</div>-->
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button :disabled="isProcessing" id="btn-login" class="btn btn-success">Login</button>
                        </div>
                    </div>
                </form>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account!
                            <router-link to="/registration">
                                Sign Up Here
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <footer-section></footer-section>
    </div>
</template>
<script>
    import {Menu, Footer} from '../'
    import {post} from '../../../helpers/api'
    import Auth from '../../../store/auth'
    import Swal from 'sweetalert2'

    export default{
        components:{
            'menu-section': Menu,
            'footer-section': Footer
        },
            data(){
                return {
                    form:{
                        email:null,
                        password:null
                    },
                    error:{},
                    isProcessing: false,
                }
            },
        methods:{
                login(){
                    this.isProcessing = true;
                    this.error = {};
                    post('/api/login',this.form)
                        .then((response)=>{
                            if(response.data.authenticated){
                                Auth.set(response.data.user_id,response.data.api_token)
                                this.$router.push('/admin/dashboard')
                            }
                        })
                        .catch((errors)=>{
                            if(errors.response.status === 422){
                                this.error = errors.response.data.errors
                                if(errors.response.data.wrong){
                                    this.error={}
                                    Swal(
                                        'Oops',
                                        errors.response.data.wrong[0],
                                        'error'
                                    );
                                }
                            }
                            this.isProcessing = false
                        })
                }
        }
    }
</script>
<style>
    #loginbox{
        margin-top:10%;
    }
</style>