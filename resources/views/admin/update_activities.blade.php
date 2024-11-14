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

      .flatpickr-buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
      }

      .clear-dates-button, .select-future-dates-button {
        padding: 5px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        color: #ffffff;
        border: none;
      }

      .clear-dates-button {
        background-color: #dc3545;
      }

      .clear-dates-button:hover {
        background-color: #c82333;
      }

      .select-future-dates-button {
        background-color: #28a745;
      }

      .select-future-dates-button:hover {
        background-color: #218838;
      }

      /* Modal Styles */
      .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
        z-index: 1000;
      }

      .modal-content {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        text-align: center;
        position: relative;
      }

      .modal-content h3 {
        color: #333333;
        margin-bottom: 15px;
      }

      .close-modal {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 18px;
        font-weight: bold;
        color: #ffffff;
        background-color: #ff3333;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .close-modal:hover {
        background-color: #ff6666;
      }

      .dates-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        max-height: 200px;
        overflow-y: auto;
      }

      .date-box-modal {
        background-color: #007bff;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
        margin: 5px;
        display: inline-block;
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
          <p><a href="javascript:history.back()" class="text-muted">Back to Activities List</a></p>
          <h1 class="form-title">Update Activities</h1>

          <form action="{{url('edit_activity', $data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
              <label>Resort Name:</label>
              <h1 style="color: black; font-weight: bold; text-decoration: underline;">{{ Auth::user()->name }}</h1>
          </div>
          
            <div class="form-group">
              <label for="title">Activity Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}" placeholder="Enter room title" required>
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter room description" required>{{$data->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="description">Location</label>
                <input class="form-control" id="location" name="location" value="{{$data->location}}" placeholder="Enter your location" required></input>
              </div>

            <div class="form-group">
              <label for="price">Adult Price</label>
              <input type="number" class="form-control" id="price" name="price" value="{{$data->price}}" placeholder="Enter price for adults" required>
            </div>

            <div class="form-group">
              <label for="price">Children Price</label>
              <input type="number" class="form-control" id="children_price" name="children_price" value="{{$data->children_price}}" placeholder="Enter price for children" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" class="form-control" id="contacts" name="contacts" value="{{$data->contacts}}" placeholder="Enter your phone number" required></input>
              </div>

          <!-- Date preview section as a modal trigger -->
          <div class="form-group">
            <button type="button" onclick="showDatesModal()" class="btn btn-info">View Entered Available Dates</button>
          </div>

          <div class="form-group">
            <label for="available_dates">Enter New Available Dates</label>
            <input type="text" id="available_dates" name="available_dates" class="form-control" value="{{ $availableDates }}">
            <small class="text-muted">Select multiple dates</small>
            <div class="flatpickr-buttons">
              <button type="button" class="select-future-dates-button" onclick="selectAllFutureDates()">Select All Future Dates</button>
              <button type="button" class="clear-dates-button" onclick="clearDates()">Clear Dates</button>
            </div>
          </div>
            <!-- Image display and upload -->
            <div class="form-group compact-form">
              <label for="image">Uploaded Front Image</label>
              <img src="/tours_activities/{{$data->image}}" alt="Front Image" class="room-image">
            </div>

            <div class="form-group compact-form">
              <input type="file" class="form-control-file" id="image" name="image">
              <small class="text-muted">Choose a new front image</small>
            </div>

            <div class="form-group compact-form">
              <label for="image">Uploaded Additional Images</label>
              <div class="image-gallery">
                @foreach ($data->images as $image)
                  <img src="/tours_activitiesAdditionalImages/{{ $image->image_path }}" alt="Room Image" class="room-image">
                @endforeach
              </div>
            </div>

            <div class="form-group">
              <input type="file" class="form-control-file" id="additionalImages" name="additionalImages[]" multiple>
              <small class="text-muted">Choose new additional images</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Activity</button>
          </form>

          <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

          <script>
            const datePicker = flatpickr("#available_dates", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                defaultDate: "{{ $availableDates }}".split(','), // Preselect dates
                minDate: "today" // Prevent selection of past dates
            });

            function selectAllFutureDates() {
                const startDate = new Date();
                const endDate = new Date(new Date().getFullYear(), 11, 31); // End of current year
                const dates = [];

                while (startDate <= endDate) {
                    dates.push(new Date(startDate).toISOString().split("T")[0]);
                    startDate.setDate(startDate.getDate() + 1);
                }

                datePicker.setDate(dates);
            }

            function clearDates() {
                datePicker.clear();
            }

            function showDatesModal() {
                const dates = "{{ $availableDates }}".split(',');
                const datesContent = document.getElementById('datesContent');
                datesContent.innerHTML = dates.map(date => `<span class="date-box-modal">${date.trim()}</span>`).join('');
                document.getElementById('datesModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('datesModal').style.display = 'none';
            }
          </script>

          <div class="form-footer">
            <p><a href="{{url('view_activities')}}" class="text-muted">Back to Activities List</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Entered Available Dates -->
    <div id="datesModal" class="modal-overlay">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal()">×</button>
            <h3>Entered Available Dates</h3>
            <div id="datesContent" class="dates-container"></div>
        </div>
    </div>
    @include('admin.footer')
  </body>
</html>
