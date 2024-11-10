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
        margin-top: 15px;
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

      .image-gallery {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
      }

      .room-image {
        width: 200px;
        height: auto;
        object-fit: cover;
        border: 2px solid #007bff;
        border-radius: 5px;
        padding: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      }

      .date-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
      }

      .date-box {
        background-color: #007bff;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
      }

      .clear-dates-button {
        background-color: #dc3545;
        color: #ffffff;
        border: none;
        padding: 5px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        margin-top: 10px;
      }

      .clear-dates-button:hover {
        background-color: #c82333;
      }

      
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
      <div class="container-fluid">

        <div class="form-container">
          <p><a href="{{url('view_room')}}" class="text-muted">Back to Rooms List</a></p>
          <h1 class="form-title">Update Rooms</h1>

          <form action="{{url('edit_room', $data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="title">Room Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{$data->room_title}}" placeholder="Enter room title" required>
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter room description" required>{{$data->description}}</textarea>
            </div>

            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" value="{{$data->price}}" placeholder="Enter room price" required>
            </div>

            <div class="form-group">
              <label for="type">Room Type</label>
              <select class="form-control" id="type" name="type">
                <option selected value="{{$data->room_type}}">{{$data->room_type}}</option>
                <option value="regular">Regular</option>
                <option value="premium">Premium</option>
                <option value="deluxe">Deluxe</option>
              </select>
            </div>

            <div class="form-group">
              <label for="wifi">Free Wifi</label>
              <select class="form-control" id="wifi" name="wifi">
                <option selected value="{{$data->wifi}}">{{$data->wifi}}</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>

            <!-- Date preview section -->
            <div class="form-group">
              <label>Entered Available Dates</label>
              <div class="date-preview">
                @foreach(explode(',', $availableDates) as $date)
                  <span class="date-box">{{ trim($date) }}</span>
                @endforeach
              </div>
            </div>

            <div class="form-group">
              <label for="available_dates">Enter New Available Dates</label>
              <input type="text" id="available_dates" name="available_dates" class="form-control" value="{{ $availableDates }}">
              <small class="text-muted">Select multiple dates</small>
              <button type="button" class="clear-dates-button" onclick="clearDates()">Clear Dates</button>
            </div>

            <!-- Image display and upload -->
            <div class="form-group compact-form">
              <label for="image">Uploaded Front Image</label>
              <img src="/room/{{$data->room_image}}" alt="Front Image" class="room-image">
            </div>

            <div class="form-group compact-form">
              <input type="file" class="form-control-file" id="image" name="image">
              <small class="text-muted">Choose a new front image</small>
            </div>

            <div class="form-group compact-form">
              <label for="image">Uploaded Additional Images</label>
              <div class="image-gallery">
                @foreach ($data->images as $image)
                  <img src="/room_images/{{ $image->image_path }}" alt="Room Image" class="room-image">
                @endforeach
              </div>
            </div>

            <div class="form-group">
              <input type="file" class="form-control-file" id="additionalImages" name="additionalImages[]" multiple>
              <small class="text-muted">Choose new additional images</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Room</button>
          </form>

          <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

          <script>
            flatpickr("#available_dates", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                defaultDate: "{{ $availableDates }}".split(','), // Preselect dates
            });

            function clearDates() {
                // Clear the dates from the input field and update Flatpickr
                document.getElementById("available_dates").flatpickr().clear();
            }
          </script>

          <div class="form-footer">
            <p><a href="{{url('view_room')}}" class="text-muted">Back to Rooms List</a></p>
          </div>
        </div>
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>
