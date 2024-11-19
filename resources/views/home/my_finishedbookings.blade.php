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
<div class="container-fluid">
    <div style="text-align: center;margin-bottom: 20px;">
        <h1 style="color: #1e49a1; font-weight: bold; font-size: 2em;">My Finished Bookings</h1>
        <button id="hideAllButton" class="btn btn-danger mt-3" onclick="confirmHideAll()">Hide All Finished Bookings</button>
        <button id="unhideAllButton" class="btn btn-success mt-3" onclick="confirmUnhideAll()">Unhide All Finished Bookings</button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
        
        <!-- Table for displaying bookings -->
        <table class="table table-striped">
            <thead>
                <tr style="color: blue">
                    <th>Ticket Number</th>
                    <th>Service Type</th>
                    <th>Service Provider</th>
                    <th>Details</th>
                    <th>Duration</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                <!-- Booked Rooms -->
                @foreach($bookedRooms as $booking)
                    @if($booking->status === 'Finished')
                        @php
                            $duration = \Carbon\Carbon::parse($booking->checkin_date)
                                ->diffInDays(\Carbon\Carbon::parse($booking->checkout_date));
                        @endphp
                        <tr>
                            <td>#{{ $booking->ticket }}</td>
                            <td>Room</td>
                            <td>{{ $booking->room->business_name }}</td>
                            <td>{{ $booking->rooms }} {{ $booking->rooms == 1 ? 'Room' : 'Rooms' }} | {{ $booking->room->room_type }}</td>
                            <td>{{ $duration }} {{ $duration == 1 ? 'day' : 'days' }}</td>
                            <td>
                                <a href="#" 
                                   class="btn btn-primary" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#reviewModal" 
                                   data-id="{{ $booking->id }}" 
                                   data-room-id="{{ $booking->room_id }}">
                                   Add Review
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach

                <!-- Other Bookings -->
                @foreach($otherBookings as $booking)
                    @if($booking->status === 'Finished')
                        @php
                            $duration = \Carbon\Carbon::parse($booking->checkin_date)
                                ->diffInDays(\Carbon\Carbon::parse($booking->checkout_date));
                        @endphp
                        <tr>
                            <td>#{{ $booking->ticket }}</td>
                            <td>Service</td>
                            <td>{{ $booking->data->title }}</td>
                            <td>{{ $booking->size + $booking->size2 + $booking->foreigners }} Guests</td>
                            <td>{{ $duration }} {{ $duration == 1 ? 'day' : 'days' }}</td>
                            <td>
                                <a href="#" 
                                   class="btn btn-primary" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#reviewOtherModal" 
                                   data-id="{{ $booking->id }}" 
                                   data-service-id="{{ $booking->tour_activity_id }}">
                                   Add Review
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Review Modals -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('submit-review') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" id="booking_id">
            <input type="hidden" name="room_id" id="room_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Submit Room Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="reviewOtherModal" tabindex="-1" aria-labelledby="reviewOtherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('submit-review-other') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_other_id" id="booking_other_id">
            <input type="hidden" name="service_id" id="service_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewOtherModalLabel">Submit Service Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
const reviewModal = document.getElementById('reviewModal');

reviewModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const bookingId = button.getAttribute('data-id'); // Extract booking ID
    const roomId = button.getAttribute('data-room-id'); // Extract room ID

    // Populate hidden fields in the form
    reviewModal.querySelector('#booking_id').value = bookingId;
    reviewModal.querySelector('#room_id').value = roomId;
});
});

document.addEventListener('DOMContentLoaded', function () {
const reviewOtherModal = document.getElementById('reviewOtherModal');

reviewOtherModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const bookingOtherId = button.getAttribute('data-id'); // Extract booking_other_id
    const serviceId = button.getAttribute('data-service-id'); // Extract service_id

    // Populate hidden fields in the form
    reviewOtherModal.querySelector('#booking_other_id').value = bookingOtherId;
    reviewOtherModal.querySelector('#service_id').value = serviceId;
});
});

function confirmHideAll() {
        if (confirm('Are you sure you want to hide all finished bookings?')) {
            document.getElementById('hideAllForm').submit();
        }
    }

    function confirmUnhideAll() {
        if (confirm('Are you sure you want to unhide all finished bookings?')) {
            document.getElementById('unhideAllForm').submit();
        }
    }
</script>
<form id="hideAllForm" action="{{ route('hideAllFinishedBookings') }}" method="POST" style="display: none;">
    @csrf
</form>
<form id="unhideAllForm" action="{{ route('unhideAllFinishedBookings') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>