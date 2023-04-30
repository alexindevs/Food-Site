<nav class="nav flex">
    <div class="nav-left flex">
    <div class="icon-one" onclick="toggleMenu()">
        <div class="hamburger hamburger-one"></div>
    </div>
    <div class="navLogo">
        <img src="public/images/logo.jpg" id="logo" alt="Cravings and More">
    </div>
    <ul class="navList">
        <li class="navLink"><a href="/" class="primary">Home</a></li>
        <li class="navLink"><a href="">Home</a></li>
        <li class="navLink"><a href="">Home</a></li>
        <li class="navLink"><a href="">Home</a></li>
        <li class="navLink"><a href="">Home</a></li>
        <li class="navLink"><a href="">Home</a></li>
    </ul>
</div>
<div class="nav-right vertical-center">
    <button class="primary btn navButton">Order Now</button>
</div>
</nav>

<style>
.vertical-center {
    margin-top: auto;
    margin-bottom: auto;
}

.nav {
    background-color: rgba(0, 0, 0, 0.182);
    color: white;
    height:  70px;
    width: 100%;
    box-shadow: 0px 3px 9px rgba(0, 0, 0, 0.182);
}



.nav-left {
    margin-right: auto;
}

.show {
    display: block;
}

.flex {
    
    display: flex;
}

.navLogo {
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 25px;
    margin-right: 40px;
}

#logo {
 width: 50px;
 height: 50px;
 border-radius: 100%;
}

.navList {
    margin-top: auto;
    margin-bottom: auto;
}

.navLink {
    display: inline-block;
    padding-right: 20px;
}

.navLink a {
    text-decoration: none;
    color: white;
    position: relative;
    font-family: 'Caveat', cursive;
}

.navLink a:after {
    content: '';
    position: absolute;
    top: 150%;
    left: 0;
    width: 0%;
    height: 2px;
    background-color: gold;
    transition: 0.7s;
    
}

.navLink a:hover:after {
    width: 100%;
}
</style>