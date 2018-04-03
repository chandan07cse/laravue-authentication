<template>
    <div>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><router-link to="/" @exact>Home</router-link></li>
                        <li><router-link to="/about">About</router-link></li>
                        <li><router-link to="/contact">Contact</router-link></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><router-link to="/registration">Signup</router-link></li>
                        <li><router-link to="/login">Login</router-link></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script></script>
<style>
.active{
    color: #fff !important;
    background: rgb(53, 73, 94) !important;
    border-left-color: #3c8dbc !important;
}
</style>