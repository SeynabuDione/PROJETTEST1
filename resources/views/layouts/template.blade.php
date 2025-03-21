
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>GESTION STOCK</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{asset('assets/css/portal.css')}}">

</head> 

<body class="app">
    <header class="app-header fixed-top">
    @include('layouts.topbar')
<!--//app-header-inner-->

<!-- Condition pour afficher la sidebarC si la route ou l'URL correspond -->
@if (Route::currentRouteName() === 'commandes.index' || 
     Route::currentRouteName() === 'commande.indexA' || 
     Request::is('client*'))  
    <!-- Sidebar et dashboard pour le client -->
    @include('layouts.sidebarC')  <!-- Affiche la sidebarC pour le client -->
    <!-- Contenu spécifique au client -->

@else 
    <!-- Sidebar par défaut -->
    @include('layouts.sidebar')  
@endif




        <!--//app-sidepanel-->
    </header><!--//app-header-->
    
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                @yield('content')
            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
</body>

			  
				
					      
				  
						      
					    

						 
	    
	  					

 
    <!-- Javascript -->          
    <script src="{{asset('assets/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>  

    <!-- Charts JS -->
    <script src="{{asset('assets/plugins/chart.js/chart.min.js')}}"></script> 
    <script src="{{asset('assets/js/index-charts.js')}}"></script> 
    
    <!-- Page Specific JS -->
    <script src="{{asset('assets/js/app.js')}}"></script> 

</body>
</html> 

