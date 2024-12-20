<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('admin.css')
    

    
    <style>
        
     
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
     
        /* Main Container */
        .form-container {
            max-width: 1000px;
            margin: auto;
            padding: 10px;
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
            font-size: 14px;
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
            
        }

        /* Form Card Layout */
        .form-grid {
            display: flex;
            gap: 10px;
            
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
           
        }

        .filters-and-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.filters {
    display: flex;
    gap: 10px; /* Space between month and year dropdowns */
}

.button-group {
    display: flex;
    gap: 5px; /* Space between each button */
    align-self: flex-end; /* Push buttons to the bottom if needed */
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
            <!-- Sidebar Navidation Menus--><span class="heading"></span>
            <ul class="list-unstyled">
                <li><a href="{{url('admin_home')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ROOMS</a>
                    <ul id="room_dropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('create_room')}}">Add Rooms</a></li>
                        <li class="active"><a href="{{url('view_room')}}">View Rooms</a></li>

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
                <li><a href="{{url('business_announcements')}}"> <i class="bi bi-bell"></i>Announcements</a></li>

            </ul>
        </nav>

        <div class="page-content">
            <div class="page-header">
            <div class="container-fluid">
                    <!-- Back to Room List Link -->
            <div style="margin-bottom: 20px;">
                <a href="{{ url('view_room') }}" class="text-muted" style="font-size: 14px; text-decoration: none; display: inline-block;">
                    <i class="fa fa-arrow-left" style="margin-right: 5px;"></i> Back to Room List
                </a>
            </div>
                    <h1 class="form-title">{{ $room->room_title }}</h1>
                    <!-- Image Section with Main and Additional Images -->
                    <div class="image-section">
                        <div>
                            <img src="/room/{{ $room->room_image }}" alt="Room Front Image" class="main-room-image" onclick="openImageModal('/room/{{ $room->room_image }}')">
                        </div>
    
                        <!-- Additional Images with Title -->
                        <div class="additional-images-container">
                            <div class="additional-images-title">Other Images</div>
                            <div class="other-images-gallery">
                                @foreach ($room->images as $image)
                                    <img src="/room_images/{{ $image->image_path }}" alt="Additional Room Image" onclick="openImageModal('/room_images/{{ $image->image_path }}')">
                                @endforeach
                            </div>
                        </div>
                    </div>
    
                    <!-- Room Details Section -->
                    <div class="room-details">
                        <p><strong>Room Type:</strong> {{ $room->room_type }}</p>
                        <p><strong>Description:</strong>{{ $room->description }} </p>
                        <!-- Offers Section -->
    <div class="room-offers">
        <p><strong>Offers:</strong></p>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
            @if ($room->offers && count(json_decode($room->offers)) > 0)
                @foreach (array_chunk(json_decode($room->offers), 5) as $columnIndex => $chunk)
                    <div style="flex: 1; min-width: 150px;">
                        @foreach ($chunk as $offerIndex => $offer)
                            <p style="font-size: 14px; margin: 0;">
                                {{ $columnIndex * 5 + $offerIndex + 1 }}. {{ $offer }}
                            </p>
                        @endforeach
                    </div>
                @endforeach
            @else
                <p style="font-size: 16px; color: gray;">No offers available.</p>
            @endif
        </div>
    </div>
                        
                        <p><strong>Available Rooms:</strong> {{ $room->available_rooms }}</p>
                        <p><strong>Max Occupancy:</strong> 
                            {{ $room->max_adults }} Adults
                            @if ($room->max_children > 0)
                                , {{ $room->max_children }} Children
                            @endif
                        </p>
                        <p><strong>Location:</strong> {{ $room->new_location }}</p>
                        <p><strong>Price:</strong> {{ $room->price }}₱</p>
                        <p><strong>Phone Number:</strong> 
                            @if ($room->contacts && count(json_decode($room->contacts)) > 0)
                                @foreach (array_chunk(json_decode($room->contacts), 5) as $columnIndex => $chunk)
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
                        </p>
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
                                
                                
                                <div class="button-group" style="padding-top: 20px">
                                    <a class="btn btn-warning" href="{{ url('toggle_status', $room->id) }}" data-toggle="tooltip" title="Change the status of the room (In Service or Out of Service)">
                                        {{ $room->status === 'In Service' ? 'In Service' : 'Out of Service' }}
                                    </a>
                                    <a class="btn btn-warning" href="{{ url('update_room', $room->id) }}" data-toggle="tooltip" title="Edit the room details">
                                        Update
                                    </a>
                                    <a onclick="return confirm('Are you sure to delete this?');" class="btn btn-danger" href="{{ url('room_delete', $room->id) }}" data-toggle="tooltip" title="Delete this room permanently">
                                        Delete
                                    </a>
                                </div>
                            </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

        

    
        <!-- Modal for Expanded Image -->
        <div id="imageModal" class="modal">
            <span class="close-modal" onclick="closeImageModal()">&times;</span>
            <img id="expandedImage" src="" alt="Expanded Image">
        </div>

                </div>

        <script>  
        
            // Initialize Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
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
        const dates = @json($room->availabilities); // Assuming availabilities are passed from the server

        if (!dates || dates.length === 0) {
            console.error("No available dates provided");
            return;
        }

        // Extract unique years from the available dates
        const years = Array.from(new Set(dates.map(date => {
            if (date && date.available_date) {
                const year = new Date(date.available_date).getFullYear();
                return year;
            }
            return null;
        }))).filter(year => year !== null).sort((a, b) => a - b);

        // Log extracted years for debugging
        console.log("Extracted years:", years);

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
        const dates = @json($room->availabilities); // Assuming availabilities are passed from the server

        if (!dates || dates.length === 0) {
            console.error("No available dates provided");
            return;
        }

        const filteredDates = dates.filter(date => {
            if (date && date.available_date) {
                const formattedDate = new Date(date.available_date);
                const dateMonth = String(formattedDate.getMonth() + 1).padStart(2, '0');
                const dateYear = formattedDate.getFullYear();
                return (month === 'all' || dateMonth === month) && (dateYear == year);
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

   
        </script>
        </div>
    

        @include('admin.footer')
    </body>
     
    </html>
