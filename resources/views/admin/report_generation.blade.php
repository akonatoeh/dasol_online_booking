<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Generation</title>
    @include('admin.css')

    <style>
        body {
            background-color: #f8f9fc;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 50px auto;
            max-width: 1200px;
        }

        .header-container {
            display: flex;
            align-items: center;
            padding-left: 150px; /* Match the header padding */
            margin-bottom: 30px;
        }

        .header-container h3 {
            margin: 0; /* Remove extra margin */
        }

        .header-container .btn-primary {
            margin-left: 20px; /* Add spacing between the header and the button */
        }

        .row-right-aligned {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 20px;
        }

        .report-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            width: 250px;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .report-card i {
            font-size: 24px;
            color: #5864f5;
            margin-bottom: 10px;
        }

        .report-card h5 {
            font-size: 16px;
            color: #333;
            margin: 0;
        }
    </style>
</head>
<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="title">
                    <h1 class="h5">Business Name: {{ Auth::user()->business_name }}</h1>
                    <p>Business Owner</p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading"></span>
            <ul class="list-unstyled">
                <li><a href="{{ url('admin_home') }}"><i class="icon-home"></i>Home</a></li>
                <li>
                    <a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-windows"></i>ROOMS</a>
                    <ul id="room_dropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('create_room') }}">Add Rooms</a></li>
                        <li><a href="{{ url('view_room') }}">View Rooms</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#tours_dropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-windows"></i>OTHER OFFERS</a>
                    <ul id="tours_dropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('create_tours_activities') }}">Add Services</a></li>
                        <li><a href="{{ url('view_tours') }}">View List of Services</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#booking_dropdown" aria-expanded="false" data-toggle="collapse"><i class="bi bi-ticket-perforated-fill"></i>VERIFY TICKETS</a>
                    <ul id="booking_dropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('view_roomBookings') }}">Room Bookings</a></li>
                        <li><a href="{{ url('view_tourBookings') }}">Service Bookings</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#approve_dropdown" aria-expanded="false" data-toggle="collapse"><i class="bi bi-ticket-perforated-fill"></i>VERIFIED TICKETS</a>
                    <ul id="approve_dropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('ongoing_bookings') }}">Approved Room Bookings</a></li>
                        <li><a href="{{ url('ongoing_bookingOthers') }}">Approved Service Bookings</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('reviews') }}"><i class="bi bi-layout-text-sidebar-reverse"></i>Reviews</a></li>
                <li  class="active"><a href="{{ url('reports') }}"><i class="bi bi-layout-text-sidebar-reverse"></i>Report Generation</a></li>
                <li><a href="{{url('business_announcements')}}"> <i class="bi bi-bell"></i>Announcements</a></li>

            </ul>
        </nav>

        <!-- Main Content -->
        <div class="container">
            <div class="header-container">
                <h3 style="color: black"><strong>Report Generation</strong></h3>
            </div>
            <div class="row-right-aligned">
                <div class="report-card">
                    <i class="bi bi-folder"></i>
                    <h5>Room Bookings</h5>
                    <a href="{{ route('generate.invoice') }}" class="btn btn-primary text-white" style="background-color: #007bff; border-color: #007bff;">Download PDF</a>
                </div>
                <div class="report-card">
                    <i class="bi bi-folder"></i>
                    <h5>Other Services</h5>
                    <a href="{{ route('generate.invoice2') }}" class="btn btn-primary text-white" style="background-color: #007bff; border-color: #007bff;">Download PDF</a>
                </div>
                <div class="report-card">
                    <i class="bi bi-folder"></i>
                    <h5>Tourist Arrival This Day</h5>
                    <a href="{{ route('generate.invoice3') }}" class="btn btn-primary text-white" style="background-color: #007bff; border-color: #007bff;">Download PDF</a>
                </div>  
                <div class="report-card">
                    <i class="bi bi-folder"></i>
                    <h5>Tourist Arrival this year</h5>
                    <a href="{{ route('generate.invoice4') }}" class="btn btn-primary text-white" style="background-color: #007bff; border-color: #007bff;">Download PDF</a>
                </div>
                      
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    @include('admin.footer')
</body>
</html>
