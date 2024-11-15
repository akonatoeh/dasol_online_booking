<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <base href="/public">
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
        /* Ticket style for the modal */
        .ticket-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .ticket-form .ticket-header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .ticket-form .ticket-header h5 {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }

        .ticket-form .ticket-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .ticket-form .ticket-body p {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .ticket-form .ticket-body p strong {
            color: #007bff;
        }

        .ticket-form .ticket-footer {
            text-align: center;
            margin-top: 20px;
        }

        .modal-footer {
            border-top: none;
        }

        .modal-dialog {
            max-width: 700px;
        }
    </style>
</head>
<body>

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
                          <li class="nav-item">
                             <a class="nav-link" href="{{url('room_page')}}">Rooms</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link" href="{{url('tours_activities_page')}}">Tours And Activities</a>
                          </li>
                          <li class="nav-item  active">
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

    <div class="page-content">
        <div class="container-fluid">
            <h1 class="form-title"><strong>My Room Bookings</strong></h1>
            
            <!-- Table for displaying bookings -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ticket Number</th>
                        <th>Name</th>
                        <th>Room Type</th>
                        <th>Size</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookedRooms as $booking)
                    <tr>
                        <td>#{{ $booking->ticket }}</td>
                        <td>{{ $booking->room->room_title }}</td>
                        <td>{{ $booking->room->room_type }}</td>
                        <td>{{ $booking->size }}</td>
                        <td>{{ $booking->checkin_date }}</td>
                        <td>{{ $booking->checkout_date }}</td>
                        <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#bookingModal{{ $booking->id }}">View Details</button>
                        </td>
                    </tr>

                    <!-- Modal for this booking -->
                    <div class="modal fade" id="bookingModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Ticket form content -->
                                    <div class="ticket-form">
                                        <div class="ticket-header">
                                            <h5>Your Booking Ticket</h5>
                                        </div>
                                        <div class="ticket-body">
                                            <div>
                                                <p><strong>Ticket Number:</strong> #{{ $booking->ticket }}</p>
                                                <p><strong>Name:</strong> {{ $booking->name }}</p>
                                                <p><strong>Email:</strong> {{ $booking->email }}</p>
                                                <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                                                <p><strong>Room Name:</strong> {{ $booking->room->room_title }}</p>
                                                <p><strong>Room Type:</strong> {{ $booking->room->room_type }}</p>
                                            </div>
                                            <div>
                                                
                                                <p><strong>Size:</strong> {{ $booking->size }}</p>
                                                <p><strong>Check-in Date:</strong> {{ $booking->checkin_date }}</p>
                                                <p><strong>Check-out Date:</strong> {{ $booking->checkout_date }}</p>
                                                <p><strong>Arrival Time:</strong> {{ $booking->arrival_time }}</p>
                                            </div>
                                        </div>
                                        <div class="ticket-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="page-content">
        <div class="container-fluid">
            <h1 class="form-title"><strong>My Tour/Activity Bookings</strong></h1>
            
            <!-- Table for displaying bookings -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ticket Number</th>
                        <th>Excursion Name</th>
                        <th>Excursion Type</th>
                        <th>Size</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($otherBookings as $data)
                    <tr>
                        <td>#{{ $data->ticket }}</td>
                        <td>{{ $data->data->title }}</td>
                        <td>{{ $data->data->type }}</td>
                        <td>{{ $data->size }}</td>
                        <td>{{ $data->checkin_date }}</td>
                        <td>{{ $data->checkout_date }}</td>
                        <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#bookingModal{{ $data->id }}">View Details</button>
                        </td>
                    </tr>

                    <!-- Modal for this booking -->
                    <div class="modal fade" id="bookingModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Ticket form content -->
                                    <div class="ticket-form">
                                        <div class="ticket-header">
                                            <h5>Your Booking Ticket</h5>
                                        </div>
                                        <div class="ticket-body">
                                            <div>
                                                <p><strong>Ticket Number:</strong> #{{ $data->ticket }}</p>
                                                <p><strong>Name:</strong> {{ $data->name }}</p>
                                                <p><strong>Email:</strong> {{ $data->email }}</p>
                                                <p><strong>Phone:</strong> {{ $data->phone }}</p>
                                                <p><strong>Excursion Name:</strong> {{ $data->data->title }}</p>
                                                <p><strong>Excursion Type:</strong> {{ $data->data->type }}</p>
                                            </div>
                                            <div>
                                                
                                                <p><strong>Size:</strong> {{ $data->size }}</p>
                                                <p><strong>Check-in Date:</strong> {{ $data->checkin_date }}</p>
                                                <p><strong>Check-out Date:</strong> {{ $data->checkout_date }}</p>
                                                <p><strong>Arrival Time:</strong> {{ $data->arrival_time }}</p>
                                            </div>
                                        </div>
                                        <div class="ticket-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('home.footer')

    <!-- Include necessary JavaScript for Modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
