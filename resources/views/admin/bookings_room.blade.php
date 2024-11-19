<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style type="text/css">
        .table_deg {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        .th_deg {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid #0056b3;
            text-align: center;
        }

        td {
            padding: 15px;
            color: #333333;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #ddd; /* Border added */
            
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:nth-child(odd) {
            background-color: #e9ecef;
        }

        tr:hover {
            background-color: #d6eaff;
        }

        /* Buttons */
        .btn-primary, .btn-danger, .btn-info {
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            text-transform: capitalize;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-info {
            background-color: #17a2b8;
            color: #ffffff;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

       
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .table_deg {
                font-size: 12px;
            }

            td, th {
                padding: 10px;
            }

            .btn-primary, .btn-danger {
                font-size: 12px;
                padding: 6px 10px;
            }
        }
    </style>

</head>
<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="title">
                    <h1 class="h5">Bussiness Name: {{ Auth::user()->business_name }}</h1>
                    <p>Business Owner</p>
                </div>
            </div>
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
                <li  class="active"><a href="#booking_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="bi bi-ticket-perforated-fill"></i>VERIFY TICKETS</a>
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
            </ul>
        </nav>

    <div class="page-content">
        <div class="container-fluid">
            <div style="text-align: center;margin-bottom: 20px; padding-top: 20px;">
                <h1 style="color: blue; font-weight: bold;  font-size: 2em;">Room Booking Tickets</h1>
            </div>
            
            <!-- Table for displaying bookings -->
            <table class="table table-striped">
                <thead>
                    <tr style="color: blue">
                        <th>Ticket Number</th>
                        <th>Name</th>
                        <th>Room(s)</th>
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
                    @if($booking->status === 'waiting') <!-- Add this condition -->
                    @php
        // Calculate duration in days
        $duration = \Carbon\Carbon::parse($booking->checkin_date)->diffInDays(\Carbon\Carbon::parse($booking->checkout_date));
        $totalPrice = $booking->room->price * $booking->rooms * $duration;
    @endphp
                    <tr>
                        <td>#{{ $booking->ticket }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->rooms }}</td>
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
                            <span style="color: green; font-weight: bold;">Approved</span>
                            @endif
                            @if($booking->status == 'Rejected')
                            <span style="color: red; font-weight: bold;">Rejected</span>
                            @endif
                            @if($booking->status == 'waiting')
                            <span style="color: blue; font-weight: bold;">Waiting</span>
                            @endif

                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-success me-2" href="{{url('approve_booking', $booking->id)}}" data-toggle="tooltip" title="Approve Booking">Approve</a>
                                <a class="btn btn-danger" href="{{url('reject_booking', $booking->id)}}" data-toggle="tooltip" title="Reject Booking">Reject</a>
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
                        <p style="font-size: 1.2em; font-weight: bold; margin-bottom: 10px;">Booking Details</p>
                        <p><strong>Name:</strong> {{ $booking->name }}</p>
                        <p><strong>Email:</strong> {{ $booking->email }}</p>
                        <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                        <p><strong>Room Name:</strong> {{ $booking->room->room_title }}</p>
                        <p><strong>Room Type:</strong> {{ $booking->room->room_type }}</p>
                        <p><strong>Room(s):</strong> {{ $booking->rooms }}</p>
                        <p><strong>Adults:</strong> {{ $booking->size }}</p>
                        <p><strong>Children:</strong> {{ $booking->size2 }}</p>
                        <p><strong>Total Price:</strong> ₱{{ number_format($totalPrice, 2) }}</p>
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

@endif <!-- End condition -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   

        <script>
            // Initialize Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function showDescriptionModal(button) {
        const description = button.getAttribute('data-description');
        document.getElementById('descriptionContent').textContent = description;
        document.getElementById('descriptionModal').style.display = 'flex';
    }

    function showDatesModal(button) {
        const dates = button.getAttribute('data-dates').split(', ');
        document.getElementById('datesContent').innerHTML = dates.map(date => `<p>${date}</p>`).join('');
        document.getElementById('datesModal').style.display = 'flex';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Pagination
    document.addEventListener("DOMContentLoaded", function() {
        const rowsPerPage = 5;
        const rows = document.querySelectorAll(".table_deg tbody tr");
        const totalRows = rows.length;
        const pageCount = Math.ceil(totalRows / rowsPerPage);
        const paginationButtonsContainer = document.getElementById("paginationButtons");
        let currentPage = 1;

        function displayRowsForPage(page) {
            rows.forEach((row, index) => {
                row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? "" : "none";
            });
        }

        function createPaginationButton(page) {
            const button = document.createElement("button");
            button.textContent = page;
            button.classList.toggle("active", page === currentPage);
            button.addEventListener("click", () => {
                currentPage = page;
                displayRowsForPage(page);
                updatePagination();
            });
            return button;
        }

        function updatePagination() {
            paginationButtonsContainer.innerHTML = ""; // Clear pagination buttons
            for (let i = 1; i <= pageCount; i++) {
                const button = createPaginationButton(i);
                paginationButtonsContainer.appendChild(button);
            }
        }

        // Next and Previous buttons
        document.getElementById("nextPage").addEventListener("click", () => {
            if (currentPage < pageCount) {
                currentPage++;
                displayRowsForPage(currentPage);
                updatePagination();
            }
        });

        document.getElementById("prevPage").addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                displayRowsForPage(currentPage);
                updatePagination();
            }
        });

        // Jump to page
        document.getElementById("jumpButton").addEventListener("click", () => {
            const pageInput = document.getElementById("jumpToPage").value;
            let page = parseInt(pageInput);

            // Default to page 1 if input is empty, invalid, or out of range
            if (isNaN(page) || page < 1) {
                page = 1;
            } else if (page > pageCount) {
                page = pageCount;
            }

            currentPage = page;
            displayRowsForPage(page);
            updatePagination();
        });

        displayRowsForPage(1); // Display the first page initially
        updatePagination(); // Set up pagination buttons
    });
</script>
    </div>

    @include('admin.footer')
</body>
</html>
