<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JavaScript and dependencies (Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
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

        /* Main Container */
        .form-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 40px;
            background-color: #f8faff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            font-family: Arial, sans-serif;
        }

        .form-title {
            font-size: 48px;
            font-weight: 700;
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        /* Image Section Styling */
        .image-section {
            display: flex;
            gap: 30px;
            justify-content: center;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .main-room-image {
            width: 300px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
        }

        .main-room-image:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.5);
        }

        .additional-images-container {
            flex: 1;
            max-width: 500px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .additional-images-title {
            font-size: 18px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 8px;
            text-align: left;
        }

        /* Scrollable Gallery Layout */
        .other-images-gallery {
            display: flex;
            gap: 8px;
            padding-bottom: 10px;
        }

        .other-images-gallery img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .other-images-gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 40px;
            color: #ffffff;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Room Details Section */
        .room-details {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            line-height: 1.6;
        }

        .room-details p {
            margin: 8px 0;
            font-size: 16px;
        }

        .room-details strong {
            font-weight: 600;
            color: #333;
        }

        /* Available Dates Styling */
        .available-dates {
            margin-top: 15px;
            font-weight: bold;
            color: #007bff;
        }

        .available-dates-table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
        }

        .available-dates-table th, .available-dates-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .available-dates-table th {
            background-color: #007bff;
            color: #fff;
        }

        .date-box {
            padding: 8px 12px;
            background-color: #e7f3ff;
            color: #007bff;
            border-radius: 5px;
            border: 1px solid #007bff;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        /* Booking Section */
        .booking-section {
            max-width: 1100px;
            margin: 40px auto;
            padding: 40px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .booking-section h2 {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Form Card Layout */
        .form-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-card {
            flex: 1 1 45%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-card label {
            font-weight: bold;
            color: #333;
            margin-top: 10px;
            display: block;
        }

        .form-card input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            outline: none;
        }

        /* Button Styling */
        .centered-booking-button, .centered-confirm-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .booking-button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .info-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
            font-size: 16px;
            color: #555;
            margin-left: 5px;
        }

        .info-icon .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%; /* Position the tooltip above the icon */
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .info-icon .tooltip-text::after {
            content: '';
            position: absolute;
            top: 100%; /* Bottom of the tooltip */
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        .info-icon:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .modal-backdrop {
    z-index: 1050;
}
.modal {
    z-index: 1060;
}
    </style>
</head>

<body class="main-layout">
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
                    <nav class="navigation navbar navbar-expand-md navbar-dark">
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
                                <li class="nav-item  active">
                                    <a class="nav-link" href="{{url('tours_activities_page')}}">Other Offers</a>
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

    <div class="page-content">
        <div class="container-fluid">
            <div class="form-container">
                <!-- Back to Room List Link -->
        <div style="margin-bottom: 20px;">
            <a href="{{ url('tours_activities_page') }}" class="text-muted" style="font-size: 14px; text-decoration: none; display: inline-block;">
                <i class="fa fa-arrow-left" style="margin-right: 5px;"></i> Back to Tours and Activities List
            </a>
        </div>
                <h1 class="form-title">{{ $data->business_name }}</h1>

                <!-- Image Section with Main and Additional Images -->
                <div class="image-section">
                    <div>
                        <img src="/tours_activities/{{ $data->image }}" alt="Room Front Image" class="main-room-image" onclick="openImageModal('/tours_activities/{{ $data->image }}')">
                    </div>

                    <!-- Additional Images with Title -->
                    <div class="additional-images-container">
                        <div class="additional-images-title">Other Images</div>
                        <div class="other-images-gallery">
                            @foreach ($data->images as $image)
                                <img src="/tours_activitiesAdditionalImages/{{ $image->image_path }}" alt="Additional Room Image" onclick="openImageModal('/tours_activitiesAdditionalImages/{{ $image->image_path }}')">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Room Details Section -->
                <div class="room-details">
                    <p><strong>Experience Title:</strong> {{ $data->title }}</p>
                    <p><strong>Experience Type:</strong> {{ $data->type }}</p>
                    <p><strong>Description:</strong> {{ $data->description }} </p>
                    <div class="room-offers">
                        <p><strong>Offers:</strong></p>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @if (!empty($data->contacts) && is_array(json_decode($data->contacts)) && count(json_decode($data->contacts)) > 0)
    @foreach (array_chunk(json_decode($data->contacts), 5) as $columnIndex => $chunk)
        <div style="flex: 1; min-width: 150px;">
            @foreach ($chunk as $contact)
                <p style="font-size: 16px; margin: 0;">
                    - {{ $contact }}
                </p>
            @endforeach
        </div>
    @endforeach
@else
    <p style="font-size: 16px; color: gray;">No contacts available.</p>
@endif
                        </div>
                    </div>
                    <p><strong>Location:</strong> {{ $data->location }}</p>
                    <p><strong>Price Starts at:</strong> {{ $data->price }}₱</p>
                    <td class="muted">The price will change if the Total Guest is more than Max Guest.</td>
                    <p><strong>Available Services:</strong> {{ $data->available_service }}</p>

                    <p><strong>Max Guest:</strong> 
                        {{ $data->max_adults }} Adults
                        @if ($data->max_children > 0)
                            , {{ $data->max_children }} Children
                        @endif
                    </p>
                    <p><strong>Phone Number:</strong> 
                        @if (!empty($data->offers) && is_array(json_decode($data->offers)) && count(json_decode($data->offers)) > 0)
    @foreach (array_chunk(json_decode($data->offers), 5) as $columnIndex => $chunk)
        <div style="flex: 1; min-width: 150px;">
            @foreach ($chunk as $offerIndex => $offer)
                <p style="font-size: 16px; margin: 0;">
                    {{ $columnIndex * 5 + $offerIndex + 1 }}. {{ $offer }}
                </p>
            @endforeach
        </div>
    @endforeach
@else
    <p style="font-size: 16px; color: gray;">No offers available.</p>
@endif

                    <div class="available-dates">
                        <label for="monthSelect">Choose Month:</label>
                        <select id="monthSelect" onchange="filterDatesByMonthAndYear()">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    
                        <select id="yearSelect" onchange="filterDatesByMonthAndYear()">
                            
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    
                        <!-- Placeholder for displaying dates -->
                        <div id="datePreview" class="date-grid">
                            <p>Select a month and year to view available dates.</p>
                        </div>
                    </div>

                <div style="padding-top: 20px" class="centered-booking-button">
                    @if ($data->status === 'In Service')
                        <a href="#bookingSection" class="booking-button">Book Now</a>
                    @else
                        <button class="booking-button" disabled style="background: gray; cursor: not-allowed;">
                            Out of Service
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Expanded Image -->
    <div id="imageModal" class="modal">
        <span class="close-modal" onclick="closeImageModal()">&times;</span>
        <img id="expandedImage" src="" alt="Expanded Image">
    </div>

    <div id="bookingSection" class="booking-section">
        <h2>Book Your Stay</h2>
        <form id="bookingForm" action="{{ route('booking_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-card">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
        
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
        
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" required>
                    
                    <label for="avail_service">Avail Service</label>
                    <input type="number" id="avail_service" name="avail_service" min="1" value="1" required>

                    <label for="guestSelect">Number of Persons</label>
                    <button type="button" class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#guestModal">
                        <i class="fa-solid fa-users"></i> Select Guests
                    </button>

    <!-- Guest Selection Modal -->
    <div class="modal fade" id="guestModal" tabindex="-1" aria-labelledby="guestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guestModalLabel">Select Number of Guests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Adult Selection -->
                    <div class="mb-3">
                        <label for="size" class="form-label">Adults(18 years and above)</label>
                        <input type="number" id="size" name="size" class="form-control" min="1" value="1" required>
                    </div>
                    <!-- Children Selection -->
                    <div class="mb-3">
                        <label for="size2" class="form-label">Children(2 to 11 years)</label>
                        <input type="number" id="size2" name="size2" class="form-control" min="0" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="foreigners" class="form-label">Indicate how many Foreigners included in the both selection.</label>
                        <input type="number" id="foreigners" name="foreigners" class="form-control" min="0" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateGuestCount()">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Display Selected Guest Count -->
    <p id="guestCountDisplay" class="mt-3">Selected Guests: 1 Adult, 0 Children, 0 Foreigners</p>
                </div>
                <div class="form-card">
                    <label for="checkin_date">Check-in Date</label>
                    <input type="date" id="checkin_date" name="checkin_date" required>
        
                    <label for="checkout_date">Check-out Date</label>
                    <input type="date" id="checkout_date" name="checkout_date" required>
        
                    <label for="arrival_time">Arrival Time</label>
                    <input type="time" id="arrival_time" name="arrival_time" required>
        
                    <label for="id_image">Upload ID Image</label>
                    <input type="file" id="id_image" name="id_image" accept="image/*" required>
        
                    <!-- Hidden input for tour_activity_id -->
                    <input type="hidden" name="tour_activity_id" value="{{ $data->id }}">
                </div>
            </div>
            <div class="centered-confirm-button">
                @auth
                    @if ($data->status === 'In Service')
                        <button type="submit" class="booking-button">Confirm Booking</button>
                    @else
                        <button type="button" class="booking-button" disabled style="background: gray; cursor: not-allowed;">
                            Out of Service
                        </button>
                    @endif
                @endauth
    
                @guest
                    @if ($data->status === 'In Service')
                        <button type="button" class="booking-button" onclick="showLoginPrompt()">Confirm Booking</button>
                    @else
                        <button type="button" class="booking-button" disabled style="background: gray; cursor: not-allowed;">
                            Out of Service
                        </button>
                    @endif
                @endguest
            </div>
        </form>
    </div>

    @include('home.footer')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                    <!-- Initialize Flatpickr -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    <!-- Script for Modal and Smooth Scroll -->
                    <script>    

document.addEventListener("DOMContentLoaded", () => {
    let restrictedDates = @json($restrictedDates);
    let restrictedFromCheckin = @json($restrictedFromCheckin);

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    // Filter out past dates for restricted dates and restrictedFromCheckin
    restrictedDates = restrictedDates.filter(date => new Date(date) >= today);
    restrictedFromCheckin = restrictedFromCheckin.filter(date => new Date(date) >= today);

    const checkinPicker = flatpickr("#checkin_date", {
        dateFormat: "Y-m-d",
        disable: [
            ...restrictedDates, // Fully booked dates
            {
                from: null,
                to: today.setDate(today.getDate() - 1), // Disable all past dates
            },
        ],
        minDate: "today",
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                const selectedDate = new Date(selectedDates[0]);
                const minCheckoutDate = new Date(selectedDate);
                minCheckoutDate.setDate(minCheckoutDate.getDate() + 1); // Checkout must be after check-in

                // Filter restricted dates to only those after the selected check-in date
                const restrictedCheckoutDates = restrictedFromCheckin.filter(
                    date => new Date(date) >= selectedDate
                );

                // Dynamically restrict checkout dates
                checkoutPicker.set("disable", [
                    ...restrictedCheckoutDates,
                    {
                        from: null,
                        to: selectedDate, // Ensure checkout starts after check-in
                    },
                ]);
                checkoutPicker.set("minDate", minCheckoutDate);
            }
        },
    });

    const checkoutPicker = flatpickr("#checkout_date", {
        dateFormat: "Y-m-d",
        disable: [
            ...restrictedDates, // Fully booked dates
            {
                from: null,
                to: today.setDate(today.getDate() - 1), // Disable all past dates
            },
        ],
        minDate: "today",
    });
});

function showLoginPrompt() {
        Swal.fire({
            title: 'Login Required',
            text: 'You need to log in to confirm your booking.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }

    document.getElementById('bookingForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from being submitted immediately

    // Show SweetAlert with Confirm and Cancel buttons
    Swal.fire({
        title: 'Confirm Booking',
        text: 'Are you sure you want to confirm this booking?',
        icon: 'question',
        showCancelButton: true, // Enable the Cancel button
        confirmButtonText: 'Yes, Confirm',
        cancelButtonText: 'Cancel', // Text for the Cancel button
        reverseButtons: true // Place Cancel button on the left
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form if the user clicks 'Yes, Confirm'
            this.submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Log the cancellation or take any necessary action
            console.log('Booking was canceled by the user.');
        }
    });
});
                         
                        function openImageModal(src) {
                            document.getElementById("expandedImage").src = src;
                            document.getElementById("imageModal").style.display = "flex";
                        }
                
                        function closeImageModal() {
                            document.getElementById("imageModal").style.display = "none";
                        }
                
                        document.querySelector('.booking-button').addEventListener('click', function(event) {
                            event.preventDefault();
                            document.getElementById('bookingSection').scrollIntoView({ behavior: 'smooth' });
                        });
                
                            // Populate years dynamically based on available dates
function populateYearDropdown() {
    const yearSelect = document.getElementById("yearSelect");
    const dates = @json($data->availabilities); // Assuming availabilities are passed from the server
    const today = new Date(); // Get the current date

    if (!dates || dates.length === 0) {
        console.error("No available dates provided");
        return;
    }

    // Filter out past dates
    const futureDates = dates.filter(date => {
        if (date && date.available_date) {
            const availableDate = new Date(date.available_date);
            return availableDate >= today; // Keep only dates >= today
        }
        return false;
    });

    // Extract unique years from the available future dates
    const years = Array.from(new Set(futureDates.map(date => {
        if (date && date.available_date) {
            const year = new Date(date.available_date).getFullYear();
            return year;
        }
        return null;
    }))).filter(year => year !== null).sort((a, b) => a - b);

    // Clear the year dropdown options
    yearSelect.innerHTML = ''; // No "All" option

    // Add unique years to the dropdown
    years.forEach(year => {
        const option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    });
}

// Filter dates by selected month and year
function filterDatesByMonthAndYear() {
    const month = document.getElementById("monthSelect").value;
    const year = document.getElementById("yearSelect").value;
    const dates = @json($data->availabilities); // Assuming availabilities are passed from the server
    const today = new Date(); // Get the current date

    if (!dates || dates.length === 0) {
        console.error("No available dates provided");
        return;
    }

    const filteredDates = dates.filter(date => {
        if (date && date.available_date) {
            const formattedDate = new Date(date.available_date);
            const dateMonth = String(formattedDate.getMonth() + 1).padStart(2, '0');
            const dateYear = formattedDate.getFullYear();
            return (
                formattedDate >= today && // Only allow future dates
                (month === 'all' || dateMonth === month) &&
                dateYear == year
            );
        }
        return false;
    });

    // Display filtered dates
    const datePreview = document.getElementById("datePreview");
    datePreview.innerHTML = ''; // Clear previous content
    if (filteredDates.length === 0) {
        datePreview.innerHTML = '<p>No dates available for the selected month and year.</p>';
        return;
    }

    let row;
    filteredDates.forEach((date, index) => {
        if (index % 10 === 0) {
            row = document.createElement("tr");
            datePreview.appendChild(row);
        }
        const dateBox = document.createElement("td");
        dateBox.className = "date-box";
        dateBox.innerHTML = new Date(date.available_date).toLocaleDateString();
        row.appendChild(dateBox);
    });
}

// Initialize the page
document.addEventListener("DOMContentLoaded", () => {
    populateYearDropdown(); // Populate year dropdown with all unique years
    filterDatesByMonthAndYear(); // Show all dates initially
});

// Fetch available future dates from room.availabilities
const availableDates = @json($data->availabilities)
    .map(date => date.available_date)
    .filter(date => new Date(date) >= new Date()); // Filter out past dates

// Disable unavailable dates in the check-in and check-out inputs
function disableUnavailableDates() {
    const checkinInput = document.getElementById("checkin_date");
    const checkoutInput = document.getElementById("checkout_date");

    const disableDates = (input) => {
        flatpickr(input, {
            dateFormat: "Y-m-d",
            enable: availableDates, // Only enable future dates
        });
    };

    disableDates(checkinInput);
    disableDates(checkoutInput);
}

// Call the function to initialize the date pickers
disableUnavailableDates();

                
                
function updateGuestCount() {
    // Get the values of adults and children
    const adults = document.getElementById('size').value;
    const children = document.getElementById('size2').value;
    const foreigners = document.getElementById('foreigners').value;

    // Display the selected guest count
    document.getElementById('guestCountDisplay').textContent = `Selected Guests: ${adults} Adult(s), ${children} Children, ${foreigners} Foreigners`;

    // Close the modal programmatically
    const guestModal = bootstrap.Modal.getInstance(document.getElementById('guestModal'));
    guestModal.hide();
                
                    // Remove modal-related classes and styles explicitly
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove()); // Remove all backdrops
                    document.body.classList.remove('modal-open'); // Remove modal-open class
                    document.body.style.overflow = ''; // Restore body scrolling
                    document.body.style.paddingRight = ''; // Remove any padding adjustments
                    document.documentElement.style.overflow = 'auto';
                
                }
                
                    </script>
</body>

</html>
