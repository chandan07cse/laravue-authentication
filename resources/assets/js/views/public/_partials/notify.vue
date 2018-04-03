<template>
    <div>
        <div class="flash flash__success text-center" v-if="flash.success">
            {{flash.success}}
        </div>
        <div class="flash flash__error" v-if="flash.error">
            {{flash.error}}
        </div>
    </div>
</template>
<script>
import Flash from '../../../helpers/flash'
    export default{
        data(){
            return{
                flash: Flash.state
            }
        }

    }
</script>
<style></style>