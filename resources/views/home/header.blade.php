<!-- header inner -->

<header>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</header>
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
                      <li class="nav-item active">
                         <a class="nav-link" href="{{url('/')}}">Home</a>
                      </li>
                      <li class="nav-item">
                         <a class="nav-link" href="{{url('about')}}">About</a>
                      </li>
                      <li class="nav-item">
                         <a class="nav-link" href="{{url('room_page')}}">Rooms</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('tours_activities_page')}}">Tours And Activities</a>
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