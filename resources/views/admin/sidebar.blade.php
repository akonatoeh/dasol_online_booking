 <div class="d-flex align-items-stretch">
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          
          <div class="title">
            <h1 class="h5">Bussiness Name: {{ Auth::user()->business_name }}</h1>
            <p>Bussiness Owner</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading"></span>
        <ul class="list-unstyled">
          <li><a href="{{url('admin_home')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ROOMS</a>
                  <ul id="room_dropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('create_room')}}">Add Rooms</a></li>
                    <li><a href="{{url('view_room')}}">View Rooms</a></li>
                    <li><a href="{{url('view_roomBookings')}}">View Room Bookings</a></li>

                  </ul>
                </li>
                <li><a href="#tours_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>TOURS & ACTIVITIES</a>
                  <ul id="tours_dropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('create_tours_activities')}}">Add Tours/Activities</a></li>
                    <li><a href="{{url('view_tours')}}">View Tours</a></li>
                        <li><a href="{{url('view_activities')}}">View Activities</a></li>
                        <li><a href="{{url('view_tourBookings')}}">View Tour Bookings</a></li>
                  </ul>
                  <ul id="tours_dropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('create_tours_activities')}}">Add Tours/Activities</a></li>
                    <li><a href="{{url('view_tours')}}">View Tours</a></li>
                        <li><a href="{{url('view_activities')}}">View Activities</a></li>
                  </ul>
                </li><li><a href="#booking_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="bi bi-ticket-perforated-fill"></i>VERIFY TICKETS</a>
                  <ul id="booking_dropdown" class="collapse list-unstyled ">
                      <li><a href="{{url('view_roomBookings')}}">Room Bookings</a></li>
                      <li><a href="{{url('view_tourBookings')}}">Tour & Activity Bookings</a></li>
                  </ul>
              </li>
              <li><a href="#approve_dropdown" aria-expanded="false" data-toggle="collapse"><i class="bi bi-ticket-perforated-fill"></i>VERIFIED TICKETS</a>
                  <ul id="approve_dropdown" class="collapse list-unstyled ">
                      <li><a href="{{url('ongoing_bookings')}}">Approved Room Bookings</a></li>
                      <li><a href="{{url('ongoing_bookingOthers')}}">Approved Tour & Activity Bookings</a></li>
                  </ul>
              </li>
                </ul>
      </nav>
      