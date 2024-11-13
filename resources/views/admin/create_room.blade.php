<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        .form-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
        }

        .form-title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-footer {
            margin-top: 30px;
            text-align: center;
        }

        input#available_dates {
            background-color: skyblue;
            color: #333333;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }

        input#available_dates::placeholder {
            color: #888888;
        }

        .flatpickr-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="title">
                    <h1 class="h5">Name: {{ Auth::user()->name }}</h1>
                    <p>Business Owner</p>
                </div>
            </div>
            <ul class="list-unstyled">
                <li><a href="{{url('admin_home')}}"> <i class="icon-home"></i>Home </a></li>
                <li class="active">
                    <a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ROOMS</a>
                    <ul id="room_dropdown" class="collapse list-unstyled">
                        <li><a href="{{url('create_room')}}">Add Rooms</a></li>
                        <li><a href="{{url('view_room')}}">View Rooms</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#tours_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>TOURS & ACTIVITIES</a>
                    <ul id="tours_dropdown" class="collapse list-unstyled">
                        <li><a href="{{url('create_tours_activities')}}">Add Tours/Activities</a></li>
                        <li><a href="{{url('view_tours')}}">View Tours</a></li>
                        <li><a href="{{url('view_activities')}}">View Activities</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="page-content">
            <div class="container-fluid">
                <div class="form-container">
                    <h1 class="form-title">Add Rooms</h1>

                    <form action="{{url('add_room')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Room Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter room title" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter room description" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter room price" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="type">Room Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="Regular">Regular</option>
                                <option value="Premium">Premium</option>
                                <option value="Deluxe">Deluxe</option>
                            </select>
                            <small class="text-muted">Select room type</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="contacts">Phone</label>
                            <input type="number" class="form-control" id="contacts" name="contacts" placeholder="Enter your phone number" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="wifi">Free Wifi</label>
                            <select class="form-control" id="wifi" name="wifi">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            <small class="text-muted">Select Yes or No</small>
                        </div>

                        <div class="form-group">
                            <label for="available_dates">Available Dates</label>
                            <input type="text" id="available_dates" name="available_dates" class="form-control" placeholder="Select date" required>
                            <div class="flatpickr-buttons">
                                <button type="button" class="btn btn-secondary" id="selectAllFutureDates">Select All Future Dates</button>
                                <button type="button" class="btn btn-secondary" id="clearAllDates">Clear All Dates</button>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                            <small class="text-muted">Choose Front Image</small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="additionalImages">Upload Additional Images</label>
                            <input type="file" class="form-control-file" id="additionalImages" name="additionalImages[]" multiple required>
                            <small class="text-muted">Choose Additional Images</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Room</button>
                    </form>

                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                    <!-- Initialize Flatpickr -->
                    <script>
                        const datePicker = flatpickr("#available_dates", {
                            mode: "multiple",
                            dateFormat: "Y-m-d",
                            minDate: "today"  // Prevents selecting past dates
                        });

                        document.getElementById("selectAllFutureDates").addEventListener("click", function() {
                            const startDate = new Date();
                            const endDate = new Date(new Date().getFullYear(), 11, 31); // Dec 31st of current year
                            const dates = [];

                            while (startDate <= endDate) {
                                dates.push(new Date(startDate).toISOString().split("T")[0]);
                                startDate.setDate(startDate.getDate() + 1);
                            }

                            datePicker.setDate(dates);
                        });

                        document.getElementById("clearAllDates").addEventListener("click", function() {
                            datePicker.clear();
                        });
                    </script>

                    <div class="form-footer">
                        <p><a href="{{url('view_room')}}" class="text-muted">Back to Rooms List</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
