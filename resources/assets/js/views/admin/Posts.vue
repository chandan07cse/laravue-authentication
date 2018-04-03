<template>
    <div>
        <menu-section></menu-section>
        <div id="message">
            {{message}}
        </div>
        <footer-section></footer-section>
    </div>
</template>
<script>
    import {Menu, Footer} from './'
    export default{
        components:{
            'menu-section': Menu,
            'footer-section': Footer
        },
        data(){
            return{
                message:"Posts Page"
            }
        }
    }
</script>
<style>
    #message{
        margin-top: 91px !important;
        margin-left: 12% !important;
        font-size: 21px !important;
        font-family: initial !important;
    }
</style>