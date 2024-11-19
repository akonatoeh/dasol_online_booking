<!DOCTYPE html>
<html lang="en">
   <head>
      <base href="/public">
      @include('home.css')
      <style>
         /* Header container */
         .header {
             height: 100px; /* Adjust as needed */
             display: flex;
             align-items: center;
             padding: 0; /* Remove default padding */
             margin: 0;  /* Remove default margin */
         }
     
         /* Logo section */
         .logo_section {
             display: flex;
             align-items: center;
         }
     
         /* Logo image styling */
         .logo img {
             width: 70px;
             height: 70px;
             float: left;
             margin-right: 10px;
         }
     
         /* Heading styling */
         .logo h1 {
             font-size: 24px; /* Adjust font size as needed */
             line-height: 1.2; /* Adjust line-height to reduce vertical space */
             margin: 0; /* Remove margin */
         }
     
         /* Navbar styling */
         .navbar-nav {
             margin-bottom: 0; /* Remove bottom margin from navbar */
         }
     
         .nav-link {
             padding: 0 10px; /* Adjust padding around nav items */
             margin: 0; /* Remove extra margin */
         }
     </style>
    
   </head>

   <body class="main-layout">
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                             <a href="{{url('home')}}">
                                <img src="images/dasollogo.png" alt="#" style="width: 70px; height: 70px; float: left; margin-right: 10px;" />
                              </a>
                        <h1>DASOL ONLINE BOOKING</h1>
        
                           </div>
                          
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item ">
                                 <a class="nav-link" href="{{url('/')}}">Home</a>
                              </li>
                              <li class="nav-item active">
                                 <a class="nav-link" href="{{url('about')}}">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('room_page')}}">Rooms</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('tours_activities_page')}}">Other Offers</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('my_bookings')}}">My Bookings</a>
                              </li>

         
                     

                              @if (Route::has('login'))

                              @auth
                                  <x-app-layout>
                                  </x-app-layout>
                              @else
                                  <li class="nav-item" style="padding-right: 10px;">
                                      <!-- Style like other nav links -->
                                      <a class="nav-link" href="{{url('login')}}"  text-decoration: none;">Login</a>
                                  </li>
                          
                                  @if (Route::has('register'))
                                      <li class="nav-item">
                                          <a class="nav-link" href="{{url('register')}}"  text-decoration: none;">Register</a>
                                      </li>
                                  @endif
                              @endauth
                          
                          @endif
                   </ul>
                </div>
             </nav>
          </div>
       </div>
    </div>
 </div>
                     
      <!-- end header inner -->
      <!-- end header -->
      <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>About Us</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about -->
      <div class="about">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-5">
                  <div class="titlepage">
                    
                     <p class="margin_0">Discover the wonders of Dasol, Pangasinan, through our convenient online booking platform. From cozy rooms to exciting tours and activities, we make planning your getaway easy and hassle-free. Experience the beauty of Dasol and create lasting memories today!</p>
                     <a class="read_more" href="Javascript:void(0)"> Read More</a>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="about_img">
                     <figure><img src="images/about.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
     

      @include('home.footer')
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>