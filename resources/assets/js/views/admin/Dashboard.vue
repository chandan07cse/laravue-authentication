<template>
    <div>
        <menu-section></menu-section>
        <notify-section></notify-section>
        <div id="message">
            {{message}}
        </div>
        <footer-section></footer-section>
    </div>
</template>
<script>
    import { Menu,Notify, Footer } from './'
    export default {
        components:{
            'menu-section': Menu,
            'notify-section': Notify,
            'footer-section': Footer
        },
        data(){
            return {
                message:'Dashboard'
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