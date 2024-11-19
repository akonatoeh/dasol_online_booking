<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        .form-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-section {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fafafa;
            margin-bottom: 20px;
        }

        .form-section h3 {
            font-size: 20px;
            font-weight: bold;
            color: #555;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control, .form-control-file, select {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        .form-control:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            display: inline-block;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .flatpickr-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .flatpickr-buttons button {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .flatpickr-buttons .select-future-dates-button {
            background-color: #28a745;
        }

        .flatpickr-buttons .select-future-dates-button:hover {
            background-color: #218838;
        }

        .flatpickr-buttons .clear-dates-button {
            background-color: #dc3545;
        }

        .flatpickr-buttons .clear-dates-button:hover {
            background-color: #c82333;
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
                  <h1 class="h5">Bussiness Name: {{ Auth::user()->business_name }}</h1>
                  <p>Business Owner</p>
              </div>
          </div>
          <ul class="list-unstyled">
              <li><a href="{{url('admin_home')}}"> <i class="icon-home"></i>Home </a></li>
              <li class="active"><a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ROOMS</a>
                  <ul id="room_dropdown" class="collapse list-unstyled ">
                      <li><a href="{{url('create_room')}}">Add Rooms</a></li>
                      <li><a href="{{url('view_room')}}">View Rooms</a></li>
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
          </ul>
      </nav>
    
    <div class="page-content">
      <div class="container-fluid">

        <div class="form-container">
          <!-- Back to Room List Link -->
          <div style="margin-bottom: 20px;">
            <a href="{{ url('view_activities') }}" class="text-muted" style="font-size: 14px; text-decoration: none; display: inline-block;">
                <i class="fa fa-arrow-left" style="margin-right: 5px;"></i> Back to Activities List
            </a>
        </div>
          <h1 class="form-title" style="color: blue;">Update Activities</h1>

          <form action="{{url('edit_activity', $data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
              <label>Bussiness Name:</label>
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
              <label for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" value="{{$data->price}}" placeholder="Enter tour price" required>
            </div>

            <div class="form-group mb-3">
              <label for="max_adults">Max Adults Occupancy</label>
              <input type="number" class="form-control" id="max_adults" name="max_adults" value="{{$data->max_adults}}" required>
          </div>

          <div class="form-group mb-3">
              <label for="max_children">Max Children Occupancy</label>
              <input type="number" class="form-control" id="max_children" name="max_children" value="{{$data->max_children}}" required>
          </div>

          <!-- Add Contacts Section -->
<div class="form-group mb-3">
  <label for="contacts">Phone Numbers</label>
  <div id="contactsOverview" class="mb-2" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; background: #f9f9f9;">
      <!-- Initial Contacts Displayed Here -->
      @if (isset($contacts) && is_countable($contacts) && count($contacts) > 0)
          @foreach ($contacts as $contact)
              <p>- {{ $contact }}</p>
          @endforeach
      @else
          <p>No contacts added yet.</p>
      @endif
  </div>
</div>
          
<div class="form-group mb-3">
  <label for="contacts">Add New Phone Number</label>
  <div class="input-group">
      <input type="tel" id="contactInput" class="form-control" placeholder="Enter phone number">
      <button type="button" class="btn btn-secondary" id="addContactButton">Add Contact</button>
  </div>
</div>
          
          <!-- Hidden Input to Store Contacts -->
          <input type="hidden" id="contacts" name="contacts" value="{{ json_encode($contacts ?? []) }}">
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
            <!-- Front Image Section -->
<div class="form-group compact-form">
  <label for="image">Uploaded Front Image</label>
  <div id="frontImagePreview" class="mb-3">
      @if ($data->image)
          <div style="position: relative; display: inline-block;">
              <img src="/tours_activities/{{$data->image}}" alt="Front Image" class="room-image" style="width: 100px; height: 100px; object-fit: cover;">
              <button type="button" class="btn btn-danger btn-sm remove-image" onclick="removeFrontImage()">Remove</button>
          </div>
      @else
          <p>No image uploaded.</p>
      @endif
  </div>
  <input type="hidden" id="removedFrontImage" name="removedFrontImage" value="">
  <input type="file" class="form-control-file" id="image" name="image" onchange="previewFrontImage()">
  <small class="text-muted">Choose a new front image</small>
</div>

<!-- Additional Images Section -->
<div class="form-group compact-form">
  <label for="additionalImages">Uploaded Additional Images</label>
  <div id="additionalImagesPreview" class="image-gallery mb-3">
      @foreach ($data->images as $image)
          <div style="position: relative; display: inline-block; margin: 5px;" data-image-id="{{ $image->id }}">
              <img src="/tours_activitiesAdditionalImages/{{ $image->image_path }}" alt="Room Image" class="room-image" style="width: 100px; height: 100px; object-fit: cover;">
              <button type="button" class="btn btn-danger btn-sm remove-image" onclick="removeExistingAdditionalImage({{ $image->id }}, this)">Remove</button>
          </div>
      @endforeach
  </div>
  <input type="hidden" id="removedAdditionalImages" name="removedAdditionalImages" value="[]">
  <input type="file" class="form-control-file" id="additionalImages" name="additionalImages[]" multiple>
  <small class="text-muted">Choose new additional images</small>
</div>

            <button type="submit" class="btn btn-primary">Update Room</button>
          </form>

          <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

          <script>
            document.addEventListener('DOMContentLoaded', function () {
    const contactsInput = document.getElementById('contacts'); // Hidden input to store contacts as JSON
    const contactsOverview = document.getElementById('contactsOverview'); // Display container for contacts
    let contacts = JSON.parse(contactsInput.value || "[]"); // Parse initial contacts if available

    // Function to update the contacts display
    function updateContactsDisplay() {
        console.log("Updating contacts display...");
        if (contacts.length > 0) {
            contactsOverview.innerHTML = contacts.map((contact, index) => `
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0; border-bottom: 1px solid #ddd;">
                    <span>${index + 1}. ${contact}</span>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeContact(${index})">Remove</button>
                </div>
            `).join('');
        } else {
            contactsOverview.innerHTML = '<p>No contacts added yet.</p>';
        }
    }

    // Function to remove a contact
    window.removeContact = function (index) {
        console.log("Removing contact at index:", index);
        contacts.splice(index, 1); // Remove the contact from the array
        contactsInput.value = JSON.stringify(contacts); // Update the hidden input
        updateContactsDisplay(); // Refresh the display
    };

    // Add contact button event listener
    document.getElementById('addContactButton').addEventListener('click', function () {
        console.log("Add Contact button clicked");
        const newContact = document.getElementById('contactInput').value.trim();

        if (newContact !== "") {
            console.log("Adding new contact:", newContact);
            contacts.push(newContact); // Add the new contact to the array
            contactsInput.value = JSON.stringify(contacts); // Update the hidden input
            document.getElementById('contactInput').value = ""; // Clear the input field
            updateContactsDisplay(); // Refresh the display
        } else {
            alert("Please enter a valid phone number.");
        }
    });

    // Initialize the display
    updateContactsDisplay();
});


document.addEventListener('DOMContentLoaded', function () {
    const offersInput = document.getElementById('offers');
    const offersOverview = document.getElementById('offersOverview');
    let offers = JSON.parse(offersInput.value || "[]");

    // Function to update the offers display
    function updateOffersDisplay() {
        if (offers.length > 0) {
            offersOverview.innerHTML = offers.map((offer, index) => `
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0; border-bottom: 1px solid #ddd;">
                    <span>${index + 1}. ${offer}</span>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeOffer(${index})">Remove</button>
                </div>
            `).join('');
        } else {
            offersOverview.innerHTML = '<p>No offers added yet.</p>';
        }
    }

    // Function to remove an offer
    window.removeOffer = function (index) {
        offers.splice(index, 1);
        offersInput.value = JSON.stringify(offers);
        updateOffersDisplay();
    };

    // Add offer button click event listener
    document.getElementById('addOfferButton').addEventListener('click', function () {
        const offerInput = document.getElementById('offerInput');
        const newOffer = offerInput.value.trim();

        if (newOffer !== "") {
            offers.push(newOffer); // Add new offer to the list
            offersInput.value = JSON.stringify(offers); // Update the hidden input with the new offers array
            offerInput.value = ""; // Clear the input field
            updateOffersDisplay();
        } else {
            alert("Please enter a valid offer.");
        }
    });

    // Initialize display
    updateOffersDisplay();
});


            // Initialize flatpickr
const datePicker = flatpickr("#available_dates", {
    mode: "multiple",
    dateFormat: "Y-m-d",
    defaultDate: "{{ $availableDates }}".split(','), // Preselect dates
    minDate: "today" // Prevent selection of past dates
});

// Function to select all future dates
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

// Function to clear all selected dates
function clearDates() {
    datePicker.clear(); // Clear the flatpickr dates
    document.getElementById('available_dates').value = ''; // Ensure input is cleared
}

// Function to show the modal with dates
function showDatesModal() {
    const dates = document.getElementById('available_dates').value.split(',');
    const datesContent = document.getElementById('datesContent');
    datesContent.innerHTML = dates
        .filter(date => date.trim() !== "")
        .map(date => `<span class="date-box-modal">${date.trim()}</span>`)
        .join('');
    document.getElementById('datesModal').style.display = 'flex';
}

// Function to close the modal
function closeModal() {
    document.getElementById('datesModal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    // Preview Front Image
    window.previewFrontImage = function () {
        const frontImageInput = document.getElementById('image');
        const frontImagePreview = document.getElementById('frontImagePreview');
        const removedFrontImageInput = document.getElementById('removedFrontImage');

        if (frontImageInput.files && frontImageInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Clear existing preview and display new image
                frontImagePreview.innerHTML = `
                    <div style="position: relative; display: inline-block;">
                        <img src="${e.target.result}" alt="Front Image" class="room-image" style="width: 100px; height: 100px; object-fit: cover;">
                        <button type="button" class="btn btn-danger btn-sm remove-image" onclick="removeFrontImage()">Remove</button>
                    </div>
                `;
                removedFrontImageInput.value = ''; // Clear the removed marker as a new image is uploaded
            };
            reader.readAsDataURL(frontImageInput.files[0]);
        }
    };

    // Remove Front Image
    window.removeFrontImage = function () {
        const frontImagePreview = document.getElementById('frontImagePreview');
        const frontImageInput = document.getElementById('image');
        const removedFrontImageInput = document.getElementById('removedFrontImage');

        // Update UI and form data
        frontImagePreview.innerHTML = '<p>No image uploaded.</p>';
        frontImageInput.value = ''; // Clear the file input
        removedFrontImageInput.value = 'true'; // Mark image for removal
    };

    // Preview and Remove Additional Images
    const additionalImagesInput = document.getElementById('additionalImages');
    const previewContainer = document.getElementById('additionalImagesPreview');

    additionalImagesInput.addEventListener('change', function () {
        previewContainer.innerHTML = ''; // Clear existing previews

        Array.from(this.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.style.position = 'relative';
                wrapper.style.display = 'inline-block';
                wrapper.style.margin = '5px';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Room Image';
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '5px';

                const removeButton = document.createElement('button');
                removeButton.innerHTML = 'Remove';
                removeButton.className = 'btn btn-danger btn-sm';
                removeButton.style.position = 'absolute';
                removeButton.style.top = '5px';
                removeButton.style.right = '5px';
                removeButton.addEventListener('click', () => {
                    wrapper.remove(); // Remove from the preview container

                    // Remove the file from the input
                    const dataTransfer = new DataTransfer();
                    const files = Array.from(additionalImagesInput.files).filter((_, i) => i !== index);
                    files.forEach((file) => dataTransfer.items.add(file));
                    additionalImagesInput.files = dataTransfer.files;
                });

                wrapper.appendChild(img);
                wrapper.appendChild(removeButton);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    });

    // Remove Existing Additional Images
    window.removeExistingAdditionalImage = function (imageId, element) {
        const removedAdditionalImages = document.getElementById('removedAdditionalImages');
        const removedImages = JSON.parse(removedAdditionalImages.value || '[]');
        removedImages.push(imageId); // Add image ID to the removal list
        removedAdditionalImages.value = JSON.stringify(removedImages);
        element.parentElement.remove(); // Remove the image from the UI
    };
});
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
