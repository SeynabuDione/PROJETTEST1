<div id="app-sidepanel" class="app-sidepanel"> 
    <div class="sidepanel-inner d-flex flex-column">
        <!-- Logo and Branding -->
        <div class="app-branding">
            <a class="app-logo" href="index.html">
                <img class="logo-icon me-2" src="assets/images/logo2.png" alt="logo">
                <span class="logo-text">ISI_BURGER</span>
            </a>
        </div><!--//app-branding-->  

        <!-- Cart option -->
<nav id="app-nav-main" class="app-nav app-nav-main">
    <ul class="app-menu list-unstyled">
        <li class="nav-item">
        <a class="nav-link" href="{{ route('commandes.index') }}">

                <span class="nav-icon">
                    <!-- Cart Icon -->
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 0a1 1 0 0 1 1 1v1h5a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h5V1a1 1 0 0 1 1-1zM6 3V2H3v7h10V3H6z"/>
                    </svg>
                </span>
                <span class="nav-link-text">Panier</span>
            </a><!--//nav-link-->
        </li><!--//nav-item-->
    </ul><!--//app-menu-->
</nav><!--//app-nav-->
