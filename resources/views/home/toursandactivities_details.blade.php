<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
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
                                    <img src="images/dasollogo.jpg" alt="#" style="width: 70px; height: 70px; float: left; margin-right: 10px;" />
                                </a>
                                <h1>DASOL ONLINE <br>BOOKING</h1>
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
                                    <a class="nav-link" href="{{url('tours_activities_page')}}">Tours And Activities</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('my_bookings')}}">My Bookings</a>
                                </li>
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
                <h1 class="form-title">{{ $data->title }}</h1>

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
                    <p><strong>Description:</strong> {{ $data->description }} </p>
                    <p><strong>Location:</strong> {{ $data->location }}</p>
                    <p><strong>Price:</strong> {{ $data->price }}₱</p>
                    <p><strong>Accommodation Type:</strong> {{ $data->type }}</p>
                    <p><strong>Phone:</strong> {{ $data->contacts }}</p>

                    <!-- Available Dates Section -->
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

                        <label for="yearSelect">Choose Year:</label>
                        <select id="yearSelect" onchange="filterDatesByMonthAndYear()">
                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                        </select>
                    </div>

                    <div id="datePreview" class="available-dates-table" style="display: block;">
                        <!-- Date boxes will be inserted here dynamically -->
                    </div>
                </div>

                <div style="padding-top: 20px" class="centered-booking-button">
                    <a href="#bookingSection" class="booking-button">Book Now</a>
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
        
                    <label for="size">Number of Persons</label>
                    <input type="number" id="size" name="size" required min="1" value="1">
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
                <button type="submit" class="booking-button">Confirm Booking</button>
            </div>
        </form>
        
    </div>

    @include('home.footer')

    <!-- Script for Modal and Smooth Scroll -->
    <script>
        // Event listener for form submission
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting immediately

            // Show SweetAlert message
            Swal.fire({
                title: 'Booking Successful!',
                text: 'Your booking has been confirmed. Thank you!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form after the user confirms the SweetAlert
                    this.submit(); // This will trigger the form submission
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

        // Function to filter dates by month and year
        function filterDatesByMonthAndYear() {
            const month = document.getElementById("monthSelect").value;
            const year = document.getElementById("yearSelect").value;
            const dates = @json($data->availabilities); // Assuming availabilities are passed from the server
            const filteredDates = dates.filter(date => {
                const formattedDate = new Date(date.available_date);
                const dateMonth = String(formattedDate.getMonth() + 1).padStart(2, '0');
                const dateYear = formattedDate.getFullYear();
                return (month === 'all' || dateMonth === month) && (year === 'all' || dateYear == year);
            });
            
            // Display the filtered dates
            const datePreview = document.getElementById("datePreview");
            datePreview.innerHTML = ''; // Clear any previous dates
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

        // Call the filter function immediately when the page loads to show all dates
        filterDatesByMonthAndYear();
    </script>
</body>

</html>
