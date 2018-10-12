<template>
    <div class="home_bg">
		<div class="container">
			<div class="inner_home">
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                    <nav class="navbar">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav">
                            <li><router-link to="/my/magazineProfile">MAGAZINE  PROFILE </router-link></li>
                            <li><router-link to="/my/myLibrary">MY  LIBRARY </router-link></li>
                            <li><router-link to="/home">MY  CUSTOMIZED PAGES</router-link></li>
                            <li><a href="#">FAQ</a></li>
                            <li><router-link to="/logout">Logout</router-link></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div>
                    <router-view class="view"></router-view>
                </div>
			</div>
		</div>
    </div>
</template>

<script>
   export default {
       data () {
           return {               
           }
       },
       mounted () {
        
       },
       created () {
           
       }
   } 
</script>