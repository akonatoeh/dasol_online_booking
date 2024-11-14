<!DOCTYPE html>
<html lang="en">
   <head>
    @include('home.css')

    <style>
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

    .ourroom {
        background-color: #f4f5f7;
        padding: 40px 0 20px 0;
    }

    .our_room .titlepage {
        text-align: center;
    }

    .ourroom .titlepage p {
        color: #121212;
        font-size: 15px;
        margin-top: 15px;
    }

    .ourroom .room {
        text-align: center;
        background-color: #fff;
        margin-bottom: 20px;
        transition: ease-in all 0.5s;
        padding: 10px;
        height: auto;
    }

    .ourroom .room .room_img {
        overflow: hidden;
    }

    .ourroom .room .room_img figure {
        margin: 0;
    }

    .ourroom .room .room_img figure img {
        width: 100%;
        transition: all .5s;
        max-height: 150px;
        object-fit: cover;
    }

    .ourroom .room .room_img figure img:hover {
        transform: scale(1.05);
    }

    .ourroom .room .bed_room {
        padding: 10px;
        height: auto;
    }

    .ourroom .room .bed_room h3 {
        color: #121212;
        font-size: 18px;
        line-height: 18px;
        font-weight: 500;
        margin: auto;
    }

    #serv_hover:hover.room {
        cursor: pointer;
        box-shadow: 0px 0px 10px rgba(29, 89, 219, 0.15);
        transition: ease-in all 0.5s;
    }

    .our_room .row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: space-between;
    }

    .our_room .col-md-3 {
        flex: 0 0 24%;
        box-sizing: border-box;
    }

    .our_room .col-md-3.col-sm-6 {
        margin-bottom: 15px;
    }

    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px; /* Increased gap between buttons */
        padding: 20px 0;
        margin: 20px 0;
    }

    /* Pagination Links */
    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 8px 14px; /* Increased padding for better clickable area */
        background-color: #f7f7f7;
        color: #007bff;
        border: 1px solid #ddd;
        border-radius: 20%;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Hover effect for pagination links */
    .pagination a:hover,
    .pagination span:hover {
        background-color: #007bff;
        color: white;
    }

    /* Disabled State (Previous/Next when not active) */
    .pagination .disabled {
        pointer-events: none;
        background-color: #e2e2e2;
        color: #aaa;
    }

    /* Active Page */
    .pagination .active {
        background-color: #007bff;
        color: white;
        pointer-events: none;
        font-weight: bold;
    }

    /* Previous/Next Buttons */
    .pagination .previous,
    .pagination .next {
        font-size: 20px;
        font-weight: bold;
        background-color: #f7f7f7;
        padding: 8px 14px;
        border-radius: 50%;
    }

    /* Disabled Previous/Next */
    .pagination .previous.disabled,
    .pagination .next.disabled {
        color: #ccc;
    }

    /* Arrow icons for Previous and Next */
    .pagination .previous::before {
        content: "←";  /* Left Arrow */
        font-size: 20px;
        color: #007bff;
    }

    .pagination .next::before {
        content: "→";  /* Right Arrow */
        font-size: 20px;
        color: #007bff;
    }

    /* Showing information text */
    .pagination .showing-text {
        font-size: 16px;
        color: #666;
        margin-right: 10px;
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
                             <img src="images/dasollogo.jpg" alt="#" style="width: 70px; height: 70px; float: left; margin-right: 10px;" />
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
                           <li class="nav-item">
                              <a class="nav-link" href="{{url('about')}}">About</a>
                           </li>
                           <li class="nav-item active">
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
      <!-- end header inner -->

      <!-- Our Rooms -->
      <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>Book Rooms Now</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Our Rooms Section -->
      <div class="ourroom">
         <div class="container">
            <div class="row">
               @foreach($rooms as $room) <!-- Fetch rooms with pagination -->
               <div class="col-md-3 col-sm-6">
                  <div id="serv_hover" class="room">
                     <div class="room_img">
                        <figure><img style="height: 200px; width:400px" src="room/{{$room->room_image}}" alt="#"/></figure>
                     </div>
                     <div class="bed_room">
                        <p><strong>{{ $room->room_title }}</strong></p>
                        <p>{{ $room->room_type }}</p>
                        <p>Price: {{ $room->price }}₱</p>
                        <p>Location: {{ $room->new_location }}</p>
                        <a class="btn btn-primary" href="{{url('room_details',$room->id)}}">Book Now</a>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="pagination">
                {{ $rooms->links() }}
            </div>
         </div>
      </div>
      <!-- end our_room -->

      <!-- Footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-4">
                     <h3>Contact Us</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> +01 1234569540</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>Menu Link</h3>
                     <ul class="link_menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li class="active"><a href="room.html">Our Room</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>Newsletter</h3>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                     </form>
                     <ul class="social_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>

      <!-- Javascript files -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- Sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>
