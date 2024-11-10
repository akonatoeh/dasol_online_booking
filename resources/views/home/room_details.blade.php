<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
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
            font-size: 28px;
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
            width: 200px;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .additional-images-container {
            flex: 1;
            max-width: 500px;
        }

        .additional-images-title {
            font-size: 18px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 8px;
            text-align: left;
        }

        /* Gallery Layout */
        .other-images-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 8px;
        }

        .other-images-gallery img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .plus-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            color: white;
            background-color: rgba(0, 123, 255, 0.8);
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
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

        .date-preview {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
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

        /* Two-Column Layout for Form Fields */
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

        /* Centered Book Now Button with Top Spacing */
        .centered-booking-button {
            display: flex;
            justify-content: center;
            margin-top: 20px; /* Adds top space for separation */
        }
        .booking-button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        /* Centered Confirm Booking Button with Top Spacing */
        .centered-confirm-button {
            display: flex;
            justify-content: center;
            margin-top: 20px; /* Adds top space for separation */
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container, .booking-section {
                padding: 20px;
            }
            .form-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body class="main-layout">
    <header>
        @include('home.header')
    </header>

    <div class="page-content">
        <div class="container-fluid">
            <div class="form-container">
                <h1 class="form-title">Room Details</h1>

                <!-- Image Section with Main and Additional Images -->
                <div class="image-section">
                    <!-- Main Room Image -->
                    <div>
                        <img src="/room/{{ $room->room_image }}" alt="Room Front Image" class="main-room-image" onclick="openImagePreview('/room/{{ $room->room_image }}')">
                    </div>

                    <!-- Additional Images with Title -->
                    <div class="additional-images-container">
                        <div class="additional-images-title">Other Images</div>
                        <div class="other-images-gallery">
                            @foreach ($room->images->take(6) as $image)
                                <img src="/room_images/{{ $image->image_path }}" alt="Additional Room Image" onclick="openImagePreview('/room_images/{{ $image->image_path }}')">
                            @endforeach
                            @if ($room->images->count() > 6)
                                <div class="plus-icon" onclick="openAllImagesModal()">+{{ $room->images->count() - 6 }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Room Details Section -->
                <div class="room-details">
                    <p><strong>Room Title:</strong> {{ $room->room_title }}</p>
                    <p><strong>Description:</strong> {{ $room->description }}</p>
                    <p><strong>Location:</strong> {{ $room->new_location }}</p>
                    <p><strong>Price:</strong> {{ $room->price }}₱</p>
                    <p><strong>Room Type:</strong> {{ $room->room_type }}</p>
                    <p><strong>Phone:</strong> {{ $room->contacts }}</p>
                    <p><strong>Free Wifi:</strong> {{ $room->wifi }}</p>

                    <!-- Available Dates inside Room Details -->
                    <div class="available-dates">Available Dates</div>
                    <div class="date-preview">
                        @foreach ($room->availabilities as $availability)
                            <span class="date-box">{{ \Carbon\Carbon::parse($availability->available_date)->format('Y-m-d') }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Centered Book Now Button -->
                <div class="centered-booking-button">
                    <a href="#bookingSection" class="booking-button">Book Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Section -->
    <div id="bookingSection" class="booking-section">
        <h2>Book Your Stay</h2>
        <form action="{{ url('book_room') }}" method="POST">
            @csrf
            <div class="form-grid">
                <!-- First Card -->
                <div class="form-card">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" required>

                    <label for="size">Number of Persons</label>
                    <input type="number" id="size" name="size" required min="1" value="1" oninput="this.value = Math.abs(this.value) || 1;">
                </div>

                <!-- Second Card -->
                <div class="form-card">
                    <label for="checkin_date">Check-in Date</label>
                    <input type="date" id="checkin_date" name="checkin_date" required>

                    <label for="checkout_date">Check-out Date</label>
                    <input type="date" id="checkout_date" name="checkout_date" required>

                    <label for="arrival_time">Arrival Time</label>
                    <input type="time" id="arrival_time" name="arrival_time" required>
                </div>
            </div>  
            
            <!-- Centered Confirm Booking Button -->
            <div class="centered-confirm-button">
                <button type="submit" class="booking-button">Confirm Booking</button>
            </div>
        </form>
    </div>

    @include('home.footer')

    <!-- Script for Modal and Smooth Scroll -->
    <script>
        // Image Preview Modal
        function openImagePreview(src) {
            document.getElementById("modalImage").src = src;
            document.getElementById("imageModal").style.display = "flex";
        }

        function closeImagePreview() {
            document.getElementById("imageModal").style.display = "none";
        }

        // All Images Modal
        function openAllImagesModal() {
            document.getElementById("allImagesModal").style.display = "flex";
        }

        function closeAllImagesModal() {
            document.getElementById("allImagesModal").style.display = "none";
        }

        // Smooth Scroll for Booking Button
        document.querySelector('.booking-button').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('bookingSection').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</body>
</html>
