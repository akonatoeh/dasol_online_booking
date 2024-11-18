<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <base href="/public">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    /* General Table Styling */
    .table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
        border: 1px solid #dee2e6;
        word-wrap: break-word;
    }

    .table th {
        background-color: #007bff;
        color: #ffffff;
        font-weight: bold;
        text-transform: uppercase;
    }

    .table td {
        background-color: #f8f9fa;
    }

    .table tbody tr:nth-child(even) td {
        background-color: #ffffff;
    }

    /* Button Styling */
    .btn {
        border-radius: 50px;
        padding: 5px 15px;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .btn-info {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-info:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Modal Styling */
    .modal-dialog {
        max-width: 800px;
        margin: auto;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        text-align: center;
        font-size: 1.5em;
    }

    .modal-body {
        padding: 20px;
        background-color: #f8f9fa;
    }

    .modal-body .details-section {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    .modal-body .details-section p {
        margin: 0;
        font-size: 14px;
    }

    .modal-footer {
        text-align: center;
        background-color: #007bff;
        color: white;
        padding: 10px;
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
                          <li class="nav-item">
                             <a class="nav-link" href="{{url('about')}}">About</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link" href="{{url('room_page')}}">Rooms</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link" href="{{url('tours_activities_page')}}">Other Offers</a>
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

<div class="page-content" style="padding-top: 100px">
    <div class="container-fluid">
        <div style="text-align: center;margin-bottom: 20px;">
            <h1 style="color: #1e49a1; font-weight: bold;  font-size: 2em;">View Room Bookings</h1>
        </div>
        
        
        <!-- Table for displaying bookings -->
        <table class="table table-striped">
            <thead>
                <tr style="color: blue">
                    <th>Ticket Number</th>
                    <th>Room Name</th>
                    <th>Room Type</th>
                    <th>Room(s)</th>
                    <th>Room Price</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Duration</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Status Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookedRooms as $booking)
                @if(!in_array($booking->status, ['Cancelled', 'Hidden'])){{-- Skip if status is Cancelled --}}
                @php
    // Calculate duration in days
    $duration = \Carbon\Carbon::parse($booking->checkin_date)->diffInDays(\Carbon\Carbon::parse($booking->checkout_date));
    $totalPrice = $booking->room->price * $booking->rooms * $duration;
@endphp



                <tr>
                    <td>#{{ $booking->ticket }}</td>
                    <td>{{ $booking->room->room_title }}</td>
                    <td>{{ $booking->room->room_type }}</td>
                    <td>{{ $booking->rooms }}</td>
                    <td>Starts at ₱{{ $booking->room->price }}</td>
                    <td>{{ $booking->checkin_date }}</td>
                    <td>{{ $booking->checkout_date }}</td>
                    <td>
                        {{ $duration }} {{ $duration == 1 ? 'day' : 'days' }}
                    </td>
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#bookingModal{{ $booking->id }}" title="View Ticket Details">View Details</button>
                    </td>
                    <td>

                        @if($booking->status == 'Approved')
                        <span style="color: rgb(0, 0, 0); font-weight: bold;">Approved</span>
                        @endif
                        @if($booking->status == 'Rejected')
                        <span style="color: red; font-weight: bold;">Rejected</span>
                        @endif
                        @if($booking->status == 'waiting')
                        <span style="color: grey; font-weight: bold;">Waiting</span>
                        @endif
                        @if($booking->status == 'Finished')
                        <span style="color: green; font-weight: bold;">Finished</span>
                        @endif
                        @if($booking->status == 'Ongoing')
                        <span style="color: blue; font-weight: bold;">Ongoing</span>
                        @endif

                    </td>

                    <td>
                        <div class="d-flex align-items-center" id="booking-{{ $booking->id }}">
                            @if($booking->status == 'Rejected')
                                <a class="btn btn-danger hide-booking" 
                                   href="{{ url('hide_bookingRoom', $booking->id) }}" 
                                   data-id="{{ $booking->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hide Booking">
                                   Hide Booking
                                </a>
                            @elseif($booking->status == 'Finished')
                                <a href="#" 
                                   class="btn btn-primary" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#reviewModal" 
                                   data-type="booking" 
                                   data-id="{{ $booking->id }}">
                                   Add Review
                                </a>
                            @else
                                <a class="btn btn-danger" href="{{ url('cancel_bookingRoom', $booking->id) }}" data-toggle="tooltip" title="Cancel Booking">Cancel Booking</a>
                            @endif
                        </div>
                    </td>
                </tr>
            
                <!-- Modal for this booking -->
<div class="modal fade" id="bookingModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
        <!-- Ticket Header -->
        <div style="background-color: #007bff; color: white; padding: 15px; display: flex; align-items: center;">
            <div style="flex: 1; font-size: 1.5em; font-weight: bold;">Room Booking Ticket</div>
            <div style="font-size: 1.2em; font-weight: bold;">Ticket #{{ $booking->ticket }}</div>
        </div>

        <!-- Ticket Body -->
        <div class="modal-body" style="padding: 0; background-color: #f8f9fa;">
            <div style="display: flex; flex-wrap: wrap; border-bottom: 2px dashed #007bff; padding: 20px;">
                <!-- Left Section -->
                <div style="flex: 2; padding: 10px; border-right: 2px dashed #007bff;">
                    <p style="font-size: 1.2em; font-weight: bold; margin-bottom: 10px;">{{ $booking->room->business_name }}</p>
                    <p><strong>Contact Person:</strong> {{ $booking->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                    <p><strong>Room Name:</strong> {{ $booking->room->room_title }}</p>
                    <p><strong>Room Type:</strong> {{ $booking->room->room_type }}</p>
                    <p><strong>Room(s):</strong> {{ $booking->rooms }}</p>
                    <p><strong>Adults:</strong> {{ $booking->size }}</p>
                    <p><strong>Children:</strong> {{ empty($booking->size2) ? '0' : $booking->size2 }}</p>
                    <p><strong>Foreigners:</strong> {{ empty($booking->foreigners) ? '0' : $booking->foreigners }}</p>
                    <p><strong>Counted Total Price:</strong>₱{{ number_format($totalPrice, 2) }}</p>
                    <p class="text-muted">This is an Indicative Price.</p>
                </div>

                <!-- Right Section -->
                <div style="flex: 2; padding: 10px; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <p><strong>Verification ID:</strong></p>
                    @if(!empty($booking->id_image))
                    <img src="{{ asset($booking->id_image) }}" alt="ID Image" class="img-fluid" 
         style="max-width: 200px; height: auto; border: 1px solid #ddd; border-radius: 4px; padding: 5px; ">
                    @else
                    <p>No ID Image available</p>
                    @endif
                    <p><strong>Arrival Time:</strong> {{ \Carbon\Carbon::parse($booking->arrival_time)->setTimezone('Asia/Manila')->format('g:i A') }}</p>
                    <p><strong>Check-in Date:</strong> {{ $booking->checkin_date }}</p>
                    <p><strong>Check-out Date:</strong> {{ $booking->checkout_date }}</p>
                    <p><strong>Duration:</strong> {{ $duration }} {{ $duration == 1 ? 'day' : 'days' }}</p>
                </div>
            </div>

            <!-- Bottom Section -->
            <div style="padding: 20px;">
                <p style="font-size: 1.1em; text-align: center; font-weight: bold;">Thank you for booking with us!</p>
            </div>
        </div>

        <!-- Ticket Footer -->
        <div style="background-color: #007bff; color: white; padding: 10px; text-align: center;">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 50px;">Close</button>
        </div>
    </div>
</div>
</div>


            <!-- Review Modal -->
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="reviewForm" action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">Add Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="type" id="reviewType">
                                <input type="hidden" name="id" id="reviewId">
                                <div class="form-group mb-3">
                                    <label for="rating">Rating:</label>
                                    <select name="rating" id="rating" class="form-control" required>
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="comment">Comment:</label>
                                    <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Write your review" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="page-content">
    <div class="container-fluid">
        <div style="text-align: center;margin-bottom: 20px;">
            <h1 style="color: #1e49a1; font-weight: bold;  font-size: 2em;">View Service Bookings</h1>
        </div>
        
        <!-- Table for displaying bookings -->
        <table class="table table-striped">
            <thead>
                
                <tr style="color: blue">
                    <th>Ticket Number</th>
                    <th>Experience Name</th>
                    <th>Price</th>
                    <th>Total Guest</th>
                    <th>Arrival Time</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Duration</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Status Update</th>

                </tr>
            </thead>
            <tbody>
                @foreach($otherBookings as $booking)
                @if(!in_array($booking->status, ['Cancelled', 'Hidden'])) {{-- Skip if status is Cancelled --}}
                
    @php
        // Calculate duration in days
        $duration = \Carbon\Carbon::parse($booking->checkin_date)->diffInDays(\Carbon\Carbon::parse($booking->checkout_date));

        // Safely calculate totalSize by ignoring size2 if it's zero
        $totalSize = $booking->size + ($booking->size2 > 0 ? $booking->size2 : 0);
        $maxPeople = $booking->data->max_adults + $booking->data->max_children;

        // Determine the price multiplier based on how much totalSize exceeds the maxPeople
        if ($totalSize > $maxPeople) {
            $multiplier = $maxPeople > 0 ? ceil($totalSize / $maxPeople) : 1; // Avoid division by zero
            $totalPrice = $multiplier * $booking->data->price * $duration;
        } else {
            $totalPrice = $booking->data->price * $duration;
        }

    @endphp

                <tr>
                    <td>#{{ $booking->ticket }}</td>
                    <td>{{ $booking->data->title }}</td>
                    <td>Starts at ₱{{ $booking->data->price }}</td>
                    <td>{{ $booking->size + $booking->size2 + $booking->foreigners}}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->arrival_time)->setTimezone('Asia/Manila')->format('g:i A') }}</td>
                    <td>{{ $booking->checkin_date }}</td>
                    <td>{{ $booking->checkout_date }}</td>
                    <td>
                        {{ $duration }} {{ $duration == 1 ? 'day' : 'days' }}
                    </td>
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#bookingModal{{ $booking->id }}" title="View Ticket Details">View Details</button>
                    </td>
                    <td>

                        @if($booking->status == 'Approved')
                        <span style="color: rgb(0, 0, 0); font-weight: bold;">Approved</span>
                        @endif
                        @if($booking->status == 'Rejected')
                        <span style="color: red; font-weight: bold;">Rejected</span>
                        @endif
                        @if($booking->status == 'waiting')
                        <span style="color: grey; font-weight: bold;">Waiting</span>
                        @endif
                        @if($booking->status == 'Finished')
                        <span style="color: green; font-weight: bold;">Finished</span>
                        @endif
                        @if($booking->status == 'Ongoing')
                        <span style="color: blue; font-weight: bold;">Ongoing</span>
                        @endif

                    </td>

                    <td>
                        <div class="d-flex align-items-center" id="booking-{{ $booking->id }}">
                            @if($booking->status == 'Rejected')
                                <a class="btn btn-danger hide-booking" 
                                   href="{{ url('hide_bookingOther', $booking->id) }}" 
                                   data-id="{{ $booking->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hide Booking">
                                   Hide Booking
                                </a>
                            @elseif($booking->status == 'Finished')
                                <a href="#" 
                                   class="btn btn-primary" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#reviewModal" 
                                   data-type="booking" 
                                   data-id="{{ $booking->id }}">
                                   Add Review
                                </a>
                            @else
                                <a class="btn btn-danger" href="{{ url('cancel_bookingRoom', $booking->id) }}" data-toggle="tooltip" title="Cancel Booking">Cancel Booking</a>
                            @endif
                        </div>
                    </td>
                </tr>
            
                <!-- Modal for this booking -->
<div class="modal fade" id="bookingModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
        <!-- Ticket Header -->
        <div style="background-color: #007bff; color: white; padding: 15px; display: flex; align-items: center;">
            <div style="flex: 1; font-size: 1.5em; font-weight: bold;">Booking Ticket</div>
            <div style="font-size: 1.2em; font-weight: bold;">Ticket #{{ $booking->ticket }}</div>
        </div>

        <!-- Ticket Body -->
        <div class="modal-body" style="padding: 0; background-color: #f8f9fa;">
            <div style="display: flex; flex-wrap: wrap; border-bottom: 2px dashed #007bff; padding: 20px;">
                <!-- Left Section -->
                <div style="flex: 2; padding: 10px; border-right: 2px dashed #007bff;">
                    <p style="font-size: 1.2em; font-weight: bold; margin-bottom: 10px;">{{ $booking->data->business_name }}</p>
                    <p><strong>Contact Person:</strong> {{ $booking->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                    <p><strong>Adults:</strong> {{ $booking->size }}</p>
                    <p><strong>Children:</strong> {{ empty($booking->size2) ? '0' : $booking->size2 }}</p>
<p><strong>Foreigners:</strong> {{ empty($booking->foreigners) ? '0' : $booking->foreigners }}</p>
                    <p><strong>Total Price:</strong> ₱{{ number_format($totalPrice) }}</p>
                    <p class="text-muted">This is an Indicative Price.</p>
                </div>

                <!-- Right Section -->
                <div style="flex: 2; padding: 10px; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <p><strong>Verification ID:</strong></p>
                    @if(!empty($booking->id_image))
                    <img src="{{ asset($booking->id_image) }}" alt="ID Image" class="img-fluid" 
         style="max-width: 200px; height: auto; border: 1px solid #ddd; border-radius: 4px; padding: 5px; ">
                    @else
                    <p>No ID Image available</p>
                    @endif
                    <p><strong>Arrival Time:</strong> {{ \Carbon\Carbon::parse($booking->arrival_time)->setTimezone('Asia/Manila')->format('g:i A') }}</p>
                    <p><strong>Check-in Date:</strong> {{ $booking->checkin_date }}</p>
                    <p><strong>Check-out Date:</strong> {{ $booking->checkout_date }}</p>
                    <p><strong>Duration:</strong> {{ $duration }} {{ $duration == 1 ? 'day' : 'days' }}</p>
                </div>
            </div>

            <!-- Bottom Section -->
            <div style="padding: 20px;">
                <p style="font-size: 1.1em; text-align: center; font-weight: bold;">Thank you for booking with us!</p>
            </div>
        </div>

        <!-- Ticket Footer -->
        <div style="background-color: #007bff; color: white; padding: 10px; text-align: center;">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 50px;">Close</button>
        </div>
    </div>
</div>
</div>

                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<input type="hidden" name="booking_id" id="reviewBookingId">
    @include('home.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const reviewModal = document.getElementById('reviewModal');

        reviewModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const bookingId = button.getAttribute('data-id');

            document.getElementById('reviewBookingId').value = bookingId;
        });
    });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
