<template>
<div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><router-link to="/login">Sign In</router-link></div>
        </div>
        <div class="panel-body" >
            <form  class="form-horizontal" role="form" @submit.prevent="register">
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Username</label>
                    <div class="col-md-9" :class="{'has-error':this.error.username}">
                        <input type="text" class="form-control" v-model="form.username">
                        <small class="has-error" v-if="error.username">{{error.username[0]}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9" :class="{'has-error':this.error.email}">
                        <input type="text" class="form-control" v-model="form.email">
                        <small class="has-error" v-if="error.email">{{error.email[0]}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password</label>
                    <div class="col-md-9" :class="{'has-error':this.error.password}">
                        <input type="password" class="form-control" placeholder="password" v-model="form.password">
                        <small class="has-error" v-if="error.password">{{error.password[0]}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="col-md-3 control-label">Confirm</label>
                    <div class="col-md-9">
                        <input class="form-control"  type="password" placeholder="password again" v-model="form.password_confirmation">
                    </div>
                </div>
                <div class="form-group">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <button  :disabled="isProcessing" type="submit" class="btn btn-info">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</template>
<script>
    import { post } from '../../helpers/api'
    import Flash from '../../helpers/flash'
export default{
    data(){
        return {
            form :{
                username: null,
                email: null,
                password: null,
                password_confirmation:null
            },
            error: {},
            isProcessing: false

        }
    },
    methods:{
        register(){
            this.isProcessing = true;
            this.error = {};
            post('/api/register',this.form)
                .then((response)=>{
//                console.log(response);
                    if(response.data.registered){
                        Flash.setSuccess('Successfully Registered');
                        this.$router.push('/login');
                    }
                    this.isProcessing = false;
                })
                .catch((errors)=>{
                    if(errors.response.status === 422){
                        this.error = errors.response.data.errors;
                    }
                    this.isProcessing = false;
                })
        }
    }
}
</script>
<style>
    #signupbox{
        margin-top:10%
    }
</style>