<!DOCTYPE html>
<html lang="en">
  <head>
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
        color: black;
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
            background-color: skyblue;  /* Set a light background color */
            color: #333333;  /* Set a dark text color */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc; /* Optional: Add a border for better visibility */
            width: 100%;  /* Optional: Make the input field full width */
        }

        input#available_dates::placeholder {
            color: #888888; /* Adjust placeholder color for visibility */
        }
    
    </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
      <div class="container-fluid">
        <div class="form-container">
          <h1 class="form-title" >Add Tours/Activities</h1>

          <form action="{{url('add_tours_activities')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
              <label>Resort Name:</label>
              <h1 style="color: black; font-weight: bold; text-decoration: underline;">{{ Auth::user()->name }}</h1>
          </div>
          
            <div class="form-group mb-3">
              <label for="title">Tour/Activity Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter tour title" required>
            </div>

            <div class="form-group mb-3">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter tour description" required></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="description">Location</label>
              <input class="form-control" id="location" name="location"  placeholder="Enter your location" required></input>
            </div>

            <div class="form-group mb-3">
              <label for="price">Adult Price</label>
              <input type="number" class="form-control" id="price" name="price" placeholder="Enter price for adult" required>
            </div>

            <div class="form-group mb-3">
              <label for="price">Children Price</label>
              <input type="number" class="form-control" id="children_price" name="children_price" placeholder="Enter price for children" required>
            </div>

            <div class="form-group mb-3">
              <label for="phone">Phone</label>
              <input type="number" class="form-control" id="contacts" name="contacts"  placeholder="Enter your phone number" required></input>
            </div>

            <div class="form-group mb-3">
              <label for="type">Tour or Activity?</label>
              <select class="form-control" id="type" name="type">
                <option value="Tour">Tour</option>
                <option value="Activity">Activity</option>
              </select>
              <small class="text-muted">Select accomodation type</small>

            </div>

            <div class="form-group">
              <label for="available_dates" style="color: white;">Available Dates</label>
              <input type="text" id="available_dates" name="available_dates" class="form-control" placeholder="Select date">

          </div>

          <div class="form-group mb-4">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <small class="text-muted">Choose Front Image</small>
          </div>

          <div class="form-group mb-4">
            <label for="image">Upload Additional Images</label>
            <input type="file" class="form-control-file" id="additionalImages" name="additionalImages[]" multiple>
            <small class="text-muted">Choose Additonal Images</small>
            
          </div>
          

            <button type="submit" class="btn btn-primary">Add Room</button>
          </form>

          <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Initialize Flatpickr -->
    <script>
        flatpickr("#available_dates", {
            mode: "multiple",
            dateFormat: "Y-m-d"
        });
    </script>

          <div class="form-footer">
            <p><a href="{{url('view_tours')}}" class="text-muted">Back to Rooms List</a></p>
          </div>
        </div>
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>

