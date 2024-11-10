<!DOCTYPE html>
<html>
<head>
    @include('admin.css')

    <style type="text/css">
        /* Table Styles */
.table_deg {
    width: 100%;
    margin: 40px auto;
    border-collapse: collapse;
    background-color: #ffffff; /* White background */
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.th_deg {
    background-color: #007bff; /* Blue background for header */
    color: #ffffff; /* White text */
    padding: 15px;
    font-weight: bold;
    text-transform: uppercase;
    border-bottom: 2px solid #0056b3; /* Darker blue bottom border */
    white-space: nowrap; /* Prevent text from wrapping in header */
}

tr {
    border-bottom: 1px solid #e0e0e0; /* Light grey border for rows */
}

td {
    padding: 15px;
    color: #333333; /* Darker text for readability */
    text-align: center;
}

/* Set specific column widths */
td:nth-child(2) { /* Description column */
    width: 30%; /* Increase width for Description */
    text-align: left; /* Align text to the left for better readability */
    white-space: normal; /* Allow text to wrap */
}

td:nth-child(1),
td:nth-child(3),
td:nth-child(4),
td:nth-child(5),
td:nth-child(6),
td:nth-child(7),
td:nth-child(8),
td:nth-child(9),
td:nth-child(10) {
    width: auto; /* Allow other columns to adjust as needed */
}


/* Add alternating row colors */
tr:nth-child(even) {
    background-color: #f8f9fa; /* Light grey for even rows */
}

tr:hover {
    background-color: #e9ecef; /* Slightly darker grey on hover */
}

/* Button Styles */
.btn-danger {
    background-color: #dc3545;
    color: #ffffff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    cursor: pointer;
    font-weight: bold;
}

.btn-danger:hover {
    background-color: #c82333; /* Darker red on hover */
}

/* Image Styles */
.room-image {
    width: 100px;
    border-radius: 5px;
}

/* Overlay for Full Description */
.description-overlay {
    display: none; /* Hidden by default */
    position: fixed; /* Fixed positioning to overlay the page */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Ensure overlay is on top */
}

.overlay-content {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    max-width: 60%;
    max-height: 80%;
    overflow-y: auto;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    text-align: left;
}
.close-overlay {
    cursor: pointer;
    text-align: right;
    font-size: 18px;
    font-weight: bold;
    color: #333333;
    margin-bottom: 10px;
}


    </style>

</head>
<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
             
              <div class="title">
                <h1 class="h5">Name: {{ Auth::user()->name }}</h1>
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
                    </ul>
          </nav>
        
          <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h1 class="form-title" >Add Tours</h1>
                    <table class="table_deg">
                        <thead>
                            <tr>
                                <th class="th_deg">Activity Title</th>
                                <th class="th_deg">Description</th>
                                <th class="th_deg">Location</th>
                                <th class="th_deg">Price</th>
                                <th class="th_deg">Accommodation</th>
                                <th class="th_deg">Phone</th>
                                <th class="th_deg">Available Dates</th>
                                <th class="th_deg">Image</th>
                                <th class="th_deg">Update</th>
                                <th class="th_deg">Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            @if ($data->type == 'Tour')
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>
                                        <span class="short-description">{{ Str::limit($data->description, 50) }}</span>
                                        <span class="full-description" style="display: none;">{{ $data->description }}</span>
                                        <br>
                                        <button class="toggle-description-btn" onclick="toggleDescription(this)">read more</button>
                                    </td>
                                    <td>{{ $data->location }}</td>
                                    <td>{{ $data->price }}₱</td>
                                    <td>{{ $data->type }}</td>
                                    <td>{{ $data->contacts }}</td>
                                    <td><ul>
                                        @foreach($data->availabilities as $availability)
                                            <li>{{ \Carbon\Carbon::parse($availability->available_date)->format('Y-m-d') }}</li>
                                        @endforeach
                                    </ul></td>
    
                                    <td>
                                        <img src="tours_activities/{{ $data->image }}" class="activity-image" alt="Activity Image">
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="{{url('update_tours',$data->id)}}">Update</a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Are you sure to delete this?');" class="btn btn-danger" href="{{url('tour_delete',$data->id)}}">Delete</a>
                                    </td>
    
                                    
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="descriptionOverlay" class="description-overlay">
            <div class="overlay-content">
                <span class="close-overlay" onclick="closeOverlay()">×</span>
                <div id="overlayDescription"></div>
            </div>
        </div>
        <script>
            function toggleDescription(button) {
        const descriptionCell = button.closest('td');
        const fullDescription = descriptionCell.querySelector('.full-description').textContent;
        
        // Display full description in overlay
        document.getElementById('overlayDescription').textContent = fullDescription;
        document.getElementById('descriptionOverlay').style.display = 'flex';
    }
    
    function closeOverlay() {
        document.getElementById('descriptionOverlay').style.display = 'none';
    }
        </script>
        @include('admin.footer')
    </body>
</html>
