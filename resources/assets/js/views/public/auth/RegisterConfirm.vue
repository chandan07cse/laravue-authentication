<template></template>
<script>
    import {post} from '../../../helpers/api'
    import Storage from '../../../store/storage'
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
                       Storage.set('mail_verification_status','Email Verification Successful');
                       this.$router.push('/login')
                   }

                }).catch((errors)=>{
                       Storage.set('mail_verification_status','Email Verification Failed');
                       this.$router.push('/login')
            })
        }
    }
</script>
<style></style>