<template>
    <div>
        <menu-section></menu-section>
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Reset Password</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
                </div>

                <div style="padding-top:30px" class="panel-body">
                    <form  class="form-horizontal" role="form" @submit.prevent="reset">
                        <div style="margin-bottom: 25px;">
                            <div class="input-group" :class="{'has-error':this.error.email}">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="text" class="form-control" placeholder="Your Email Please" v-model="form.email">
                            </div>
                            <small class="has-error" v-if="error.email">{{error.email[0]}}</small>
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button :disabled="isProcessing" id="btn-login" class="btn btn-success">Send Me Password Reset Link</button>
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
    import {Menu,Footer} from '../'
    import { post } from '../../../helpers/api'
    import Swal from 'sweetalert2'
    export default{
        components:{
            'menu-section':Menu,
            'footer-section': Footer
        },
        data(){
            return{
                form:{
                    email:null,
                },
                isProcessing:false,
                error:{}
            }
        },
        methods:{
            reset(){
                this.isProcessing = true;
                post('/api/send_reset_pass_link',this.form)
                    .then((response)=>{
                        if(response.data.sending_email)
                        {
                            Swal(
                                'Reset',
                                'Please Check Your Email',
                                'question'
                            );
                            this.error = {};
                            this.form.email = null;

                        }
                        this.isProcessing = false;
                    })
                    .catch((errors)=>{
                        if(errors.response.status === 422)
                            this.error = errors.response.data.errors;
                        this.isProcessing = false;
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