 <div class="d-flex align-items-stretch">
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          
          <div class="title">
            <h1 class="h5">Bussiness Name: {{ Auth::user()->name }}</h1>
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
                  </ul>
                </li>
                <li><a href="#tours_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>TOURS & ACTIVITIES</a>
                  <ul id="tours_dropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('create_tours_activities')}}">Add Tours/Activities</a></li>
                    <li><a href="{{url('view_tours')}}">View Tours</a></li>
                    <li><a href="{{url('view_activities')}}">View Activities</a></li>
                  </ul>
                </li>
                </ul>
      </nav>