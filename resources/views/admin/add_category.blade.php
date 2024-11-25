<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
      .form-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 40px;
        background-color: #ffffff;
        
      }

      .form-title {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: center;
      }

      .form-group label {
        font-weight: bold;
        color: black;
      }

      .form-control {
        border-radius: 5px;
      }

      .btn-primary {
        width: 100%;
        padding: 10px;
        font-size: 18px;
        border-radius: 5px;
        background-color: #007bff;
        border: none;
      }

      .btn-primary:hover {
        background-color: #0056b3;
      }

      .form-footer {
        margin-top: 30px;
        text-align: center;
      }

  
      input#available_dates {
            background-color: skyblue;
            color: #333333;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }

        input#available_dates::placeholder {
            color: #888888;
        }

        .flatpickr-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .image-gallery {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
      }

      .room-image {
        width: 200px;
        height: auto;
        object-fit: cover;
        border: 2px solid #007bff;
        border-radius: 5px;
        padding: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      }

      .clear-dates-button, .select-future-dates-button {
        padding: 5px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        color: #ffffff;
        border: none;
      }

      .clear-dates-button {
        background-color: #dc3545;
      }

      .clear-dates-button:hover {
        background-color: #c82333;
      }

      .select-future-dates-button {
        background-color: #28a745;
      }

      .select-future-dates-button:hover {
        background-color: #218838;
      }
    
    </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  </head>
  <body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
      <nav id="sidebar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            
            <div class="title">
              <h1 class="h5">Bussiness Name: {{ Auth::user()->business_name }}</h1></h1>
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
                  <li  class="active"><a href="#tours_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>TOURS & ACTIVITIES</a>
                    <ul id="tours_dropdown" class="collapse list-unstyled ">
                      <li><a href="{{url('create_tours_activities')}}">Add Tours/Activities</a></li>
                      <li><a href="{{url('view_tours')}}">View Tours</a></li>
                      <li><a href="{{url('view_activities')}}">View Activities</a></li>
                    </ul>
                  </li>
                  <li><a href="#booking_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="bi bi-ticket-perforated-fill"></i>VERIFY TICKETS</a>
                    <ul id="booking_dropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('view_roomBookings')}}">Room Bookings</a></li>
                        <li><a href="{{url('view_tourBookings')}}">Tour & Activity Bookings</a></li>
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
                <li><a href="{{url('business_announcements')}}"> <i class="bi bi-bell"></i>Announcements</a></li>

                  </ul>
        </nav>

    <div class="page-content">
      <div class="container-fluid">
        <div class="form-container">
          <h1 class="form-title" style="color: blue;">Categories</h1>

          <form action="{{ url('select_category') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
            </div>
            <div class="form-group mb-3">
                <label for="type">Service Type</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="Enter type" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
        



          <div class="form-footer">
            <p><a href="{{url('view_tours')}}" class="text-muted">Back to List</a></p>
          </div>
        </div>
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>

