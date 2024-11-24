<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('admin.css')

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .main-container {
            display: flex;
            margin-left: 300px;
            padding: 20px;
        }

        .announcement-section {
            flex: 1;
            margin: 0 auto;
            max-width: 1200px;
        }

        .announcement-section h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .announcement-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .announcement-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .announcement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .announcement-card h3 {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .announcement-card p {
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }

        .announcement-card .summary {
            display: block;
        }

        .announcement-card .full-content {
            display: none;
        }

        .announcement-card small {
            font-size: 12px;
            color: #666;
        }

        .announcement-card .read-more {
            display: inline-block;
            margin-top: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .announcement-card .read-more:hover {
            text-decoration: underline;
        }

        .no-announcements {
            text-align: center;
            color: #666;
            font-size: 18px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    @include('admin.header')
    
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
                    
                    </ul>
                  </li>
                  <li><a href="#tours_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>OTHER OFFERS</a>
                    <ul id="tours_dropdown" class="collapse list-unstyled ">
                      <li><a href="{{url('create_tours_activities')}}">Add Services</a></li>
                      <li><a href="{{url('view_tours')}}">View List of Services</a></li>
                    </ul>
                  </li>
                  <li><a href="#booking_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="bi bi-ticket-perforated-fill"></i>VERIFY TICKETS</a>
                    <ul id="booking_dropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('view_roomBookings')}}">Room Bookings</a></li>
                        <li><a href="{{url('view_tourBookings')}}">Service Bookings</a></li>
                    </ul>
                </li>
                <li><a href="#approve_dropdown" aria-expanded="false" data-toggle="collapse"><i class="bi bi-ticket-perforated-fill"></i>VERIFIED TICKETS</a>
                    <ul id="approve_dropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('ongoing_bookings')}}">Approved Room Bookings</a></li>
                        <li><a href="{{url('ongoing_bookingOthers')}}">Approved Services Bookings</a></li>
                    </ul>
                </li>
                <li><a href="{{url('reviews')}}"> <i class="bi bi-layout-text-sidebar-reverse"></i>Reviews</a></li>
                <li><a href="{{url('report_generation')}}"> <i class="bi bi-layout-text-sidebar-reverse"></i>Report Generation</a></li>
                <li  class="active"><a href="{{url('business_announcements')}}"> <i class="bi bi-bell"></i>Announcements</a></li>
                  </ul>
                  
        </nav>

        <div class="main-container">
            <div class="announcement-section">
                <h2 style="color: #007bff; font-size: 34px;"><strong>Announcements</strong></h2>

                @if($announcements->isEmpty())
                    <p class="no-announcements">No announcements available at the moment.</p>
                @else
                    <div class="announcement-cards">
                        @foreach($announcements as $announcement)
                            <div class="announcement-card">
                                <h3>{{ $announcement->title }}</h3>
                                <p class="summary">{{ Str::limit($announcement->content, 300, '...') }}</p>
                                <p class="full-content" style="display: none;">{{ $announcement->content }}</p>
                                <small>Posted {{ $announcement->created_at->diffForHumans() }}</small>
                                <a href="#" class="read-more" onclick="toggleContent(event, this)">Read More</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleContent(event, link) {
            event.preventDefault(); // Prevent page reload
            const card = link.closest('.announcement-card');
            const summary = card.querySelector('.summary');
            const fullContent = card.querySelector('.full-content');
            const isExpanded = fullContent.style.display === 'block';

            if (isExpanded) {
                // Collapse content
                summary.style.display = 'block';
                fullContent.style.display = 'none';
                link.textContent = 'Read More';
            } else {
                // Expand content
                summary.style.display = 'none';
                fullContent.style.display = 'block';
                link.textContent = 'Read Less';
            }
        }
    </script>
</body>
</html>
