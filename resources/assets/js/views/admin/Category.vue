<template>
    <div>
        <menu-section></menu-section>
        <notification-section></notification-section>
        <div id="message">
            {{message}}
        </div>
        <footer-section></footer-section>
    </div>
</template>
<script>
    import {Menu, Notify, Footer} from './'
    import Flash from '../../helpers/flash'
    export default{
        components:{
            'menu-section': Menu,
            'notification-section':Notify,
            'footer-section': Footer
        },
        data(){
            return{
                message:"Category Page",
                flash: Flash.state
            }
        }
    }
</script>
<style>
    #message{
        margin-top: 91px !important;
        margin-left: 25% !important;
        font-size: 21px !important;
        font-family: initial !important;
    }
</style>