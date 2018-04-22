<template>
    <div>
        <menu-section></menu-section>
        <div id="loginbox" v-if="show" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Please Input Your New Password</div>
                </div>

                <div style="padding-top:30px" class="panel-body" >
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    <form  class="form-horizontal" role="form" method="POST" @submit.prevent="reset_password">
                        <div style="margin-bottom: 25px;">
                            <div class="input-group" :class="{'has-error':this.error.password}">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Your Password Please" v-model="form.password">
                            </div>
                            <small class="has-error" v-if="error.password">{{error.password[0]}}</small>
                        </div>
                        <div style="margin-bottom: 25px;">
                            <div class="input-group" :class="{'has-error':this.error.password_confirmation}">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Confirm Your Password Please" v-model="form.password_confirmation">
                            </div>
                            <small class="has-error" v-if="error.password_confirmation">{{error.password_confirmation[0]}}</small>
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button :disabled="isProcessing" id="btn-login" class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer-section></footer-section>
    </div>
</template>
<script>
   import {post} from '../../../helpers/api'
   import {Menu,Footer} from '../'
   import Swal from 'sweetalert2'
    export default{
       components:{
         'menu-section': Menu,
         'footer-section': Footer
       },
       data(){
           return {
               verify_token:{
                   token: this.$route.params.token
               },
               form:{
                    password: null,
                    password_confirmation: null,
                    verify_token: this.$route.params.token
               },
               isProcessing: false,
               show:false,
               error:{
                   password:null,
                   password_confirmation:null
               }
           }
       },
        created(){
           post('/api/reset/pass',this.verify_token)
               .then((response)=>{
                    if(response.data.state){
                        this.show = true;
                    }
               })
               .catch((errors)=>{
                 if(errors.response.status === 404)
//                     Flash.setError("Bad Attempt!");
                   Swal(
                       'Bad Attempt!',
                       'Token Expired',
                       'danger'
                   );
               })
        },
        methods:{
            reset_password(){
//                this.isProcessing = true;
                post('/api/resetting/password',this.form)
                    .then((response)=>{
                       if(response.data.reset){
                           this.$router.push('/login');
                           Swal(
                               'Great!',
                               'Your Password Changed Successfully',
                               'success'
                           )
                       }
                    })
                    .catch((err)=>{
                        if(err.response.status===422){
                            this.error = err.response.data.errors
                        }
                    });
            }
        }
    }
</script>
<style>
    #loginbox{
        margin-top:10%;
    }
</style>