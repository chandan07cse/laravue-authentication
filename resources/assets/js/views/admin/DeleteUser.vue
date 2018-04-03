<template>

</template>
<script>
    import {del} from '../../helpers/api'
    export default{
        data(){
            return{
                id:this.$route.params.id
            }
        },
        mounted(){
            del('/api/delete/user/'+this.id)
                .then((response)=>{
                    alert("id : "+response.data.id);
                })
                .catch((err)=>{

                })


        }
    }
</script>
<style></style>