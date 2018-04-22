<template></template>
<script>
    import {post} from '../../../helpers/api'
    import Swal from 'sweetalert2'
    export default{
        data(){
          return {
              verify_token:{
                  activation_token:this.$route.params.activation_token
              }
          }
        },
        created(){
            post('/api/registration/confirmed',this.verify_token)
                .then((response)=>{
                   if(response.data.verified){
                       Swal(
                           'Great!',
                           'Email Verification Successful',
                           'success'
                       );
                       this.$router.push('/login')
                   }

                }).catch((errors)=>{
                        Swal({
                            title: "Email Verification Failed",
                            text: "Please Confirm Your Email Address",
                            type: "warning"
                        });
                       this.$router.push('/login')
            })
        }
    }
</script>
<style></style>