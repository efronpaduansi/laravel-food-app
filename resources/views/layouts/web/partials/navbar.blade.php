 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">
     <div class="container d-flex align-items-center justify-content-between">

         <a href="{{ route('web.home') }}" class="logo d-flex align-items-center me-auto me-lg-0">
             <!-- Uncomment the line below if you also wish to use an image logo -->
             <!-- <img src="assets/img/logo.png" alt=""> -->
             <h4>DAPOER MASAGENA<span></span></h4>
         </a>

         <nav id="navbar" class="navbar">
             <ul>
                 <li><a href="{{ route('web.home') }}">Home</a></li>
                 <li><a href="#menu">Menu</a></li>
                 @auth
                     <li class="dropdown"><a href=""><span>Hi, {{ Auth()->user()->name }}</span> <i
                                 class="bi bi-chevron-down dropdown-indicator"></i></a>
                         <ul>
                             <li><a href="{{ route('guest.home') }}">Your Dashboard</a></li>
                         </ul>
                     </li>
                 @endauth
             </ul>
         </nav><!-- .navbar -->

         @auth
             <a href="{{ route('auth.logout') }}" class="get-started-btn scrollto"
                 onclick="return confirm('Anda yakin untuk keluar?')">Logout</a>
         @else
             <a class="btn-book-a-table" href="{{ route('auth.login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
         @endauth
         <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
         <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

     </div>
 </header>
 <!-- End Header -->
