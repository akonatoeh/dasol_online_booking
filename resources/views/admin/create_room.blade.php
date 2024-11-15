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
                    <h1 class="form-title" style="color: blue;">Add Rooms</h1>
                    

                    <form action="{{url('add_room')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Bussiness Name:</label>
                            <h1 style="color: black; font-weight: bold; text-decoration: underline;">{{ Auth::user()->name }}</h1>
                        </div>
                        
                        
                        <div class="form-group mb-3">
                            <label for="title">Room Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter room title" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter room description" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="offers">Short Description of Offers</label>
                            <div id="offersOverview" class="mb-2" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; background: #f9f9f9; display: flex; flex-direction: column; gap: 10px;">
                                <p>No offers added yet.</p>
                            </div>
                            
                            <div class="input-group">
                                <input type="text" id="offerInput" class="form-control" placeholder="Enter an offer">
                                <button type="button" class="btn btn-secondary" id="addOfferButton">Add Offer</button>
                            </div>
                            
                            <!-- Hidden Input to Store Offers as JSON -->
                            <input type="hidden" id="offers" name="offers">
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
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="price">Room Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter room price" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="available_rooms">Available Rooms</label>
                            <input type="number" class="form-control" id="available_rooms" name="available_rooms" placeholder="Enter available rooms" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="max_adults">Max Adults Occupancy</label>
                            <input type="number" class="form-control" id="max_adults" name="max_adults" placeholder="Enter max adult(s)" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="max_children">Max Children Occupancy</label>
                            <input type="number" class="form-control" id="max_children" name="max_children" placeholder="Enter max children" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="contacts">Phone Numbers</label>
                            <div id="contactsOverview" class="mb-2" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; background: #f9f9f9; display: flex; flex-direction: column; gap: 10px;" required>
                                <p>No contacts added yet.</p>
                            </div>
                            
                            <div class="input-group">
                                <input type="text" id="contactInput" class="form-control" placeholder="Enter phone number">
                                <button type="button" class="btn btn-secondary" id="addContactButton">Add Contact</button>
                            </div>
                            
                            <!-- Hidden Input to Store Contacts as JSON -->
                            <input type="hidden" id="contacts" name="contacts">
                        </div>
                        

                        <div class="form-group">
                            <label for="available_dates">Available Dates</label>
                            <input type="text" id="available_dates" name="available_dates" class="form-control" placeholder="Select date" required>
                            <div class="flatpickr-buttons">
                                <button type="button" class="select-future-dates-button" id="selectAllFutureDates">Select All Future Dates</button>
                                <button type="button" class="clear-dates-button" id="clearAllDates">Clear All Dates</button>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required onchange="previewImageWithRemove(this, 'imagePreview')">
                            <small class="text-muted">Choose Front Image</small>
                            <!-- Preview Container -->
                            <div id="imagePreview" style="margin-top: 10px;"></div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="additionalImages">Upload Additional Images</label>
                            <input type="file" class="form-control-file" id="additionalImages" name="additionalImages[]" multiple required onchange="previewImagesWithRemove(this, 'additionalImagesPreview')">
                            <small class="text-muted">Choose Additional Images</small>
                            <!-- Preview Container -->
                            <div id="additionalImagesPreview" style="display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap;"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Room</button>
                    </form>

                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                    <!-- Initialize Flatpickr -->
                    <script>

                        

const contactInput = document.getElementById("contactInput");
    const addContactButton = document.getElementById("addContactButton");
    const contactsOverview = document.getElementById("contactsOverview");
    const contactsHiddenInput = document.getElementById("contacts");

    let contacts = []; // Initialize an empty array for contacts

    // Add Contact button event listener
    addContactButton.addEventListener("click", () => {
        const newContact = contactInput.value.trim();

        if (newContact) {
            contacts.push(newContact); // Add to contacts array
            contactInput.value = ""; // Clear the input field

            // Update the contacts overview display
            updateContactsOverview();

            // Update the hidden input value to JSON
            contactsHiddenInput.value = JSON.stringify(contacts);
        } else {
            alert("Please enter a valid phone number.");
        }
    });

    // Function to update the contacts display with remove buttons
    function updateContactsOverview() {
        contactsOverview.innerHTML = ""; // Clear current content

        if (contacts.length > 0) {
            contacts.forEach((contact, index) => {
                const wrapper = document.createElement("div");
                wrapper.style.display = "flex";
                wrapper.style.justifyContent = "space-between";
                wrapper.style.alignItems = "center";
                wrapper.style.borderBottom = "1px solid #ddd";
                wrapper.style.padding = "5px";

                const contactText = document.createElement("span");
                contactText.textContent = `${index + 1}. ${contact}`;

                const removeButton = document.createElement("button");
                removeButton.textContent = "Remove";
                removeButton.style.backgroundColor = "red";
                removeButton.style.color = "white";
                removeButton.style.border = "none";
                removeButton.style.borderRadius = "3px";
                removeButton.style.padding = "3px 10px";
                removeButton.style.cursor = "pointer";

                // Add remove functionality
                removeButton.addEventListener("click", () => {
                    // Remove the contact from the array
                    contacts = contacts.filter((_, i) => i !== index);

                    // Update the hidden input and the UI
                    updateContactsOverview();
                    contactsHiddenInput.value = JSON.stringify(contacts);
                });

                wrapper.appendChild(contactText);
                wrapper.appendChild(removeButton);
                contactsOverview.appendChild(wrapper);
            });
        } else {
            contactsOverview.innerHTML = "<p>No contacts added yet.</p>";
        }
    }



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

                        

                        const offerInput = document.getElementById("offerInput");
    const addOfferButton = document.getElementById("addOfferButton");
    const offersOverview = document.getElementById("offersOverview");
    const offersHiddenInput = document.getElementById("offers");

    let offers = []; // Initialize an empty array for offers

    // Add Offer button event listener
    addOfferButton.addEventListener("click", () => {
        const newOffer = offerInput.value.trim();

        if (newOffer) {
            offers.push(newOffer); // Add to offers array
            offerInput.value = ""; // Clear the input field

            // Update the offers overview display
            updateOffersOverview();

            // Update the hidden input value to JSON
            offersHiddenInput.value = JSON.stringify(offers);
        } else {
            alert("Please enter a valid offer.");
        }
    });

    // Function to update the offers display with remove buttons
    function updateOffersOverview() {
        offersOverview.innerHTML = ""; // Clear current content

        if (offers.length > 0) {
            offers.forEach((offer, index) => {
                const wrapper = document.createElement("div");
                wrapper.style.display = "flex";
                wrapper.style.justifyContent = "space-between";
                wrapper.style.alignItems = "center";
                wrapper.style.borderBottom = "1px solid #ddd";
                wrapper.style.padding = "5px";

                const offerText = document.createElement("span");
                offerText.textContent = `${index + 1}. ${offer}`;

                const removeButton = document.createElement("button");
                removeButton.textContent = "Remove";
                removeButton.style.backgroundColor = "red";
                removeButton.style.color = "white";
                removeButton.style.border = "none";
                removeButton.style.borderRadius = "3px";
                removeButton.style.padding = "3px 10px";
                removeButton.style.cursor = "pointer";

                // Add remove functionality
                removeButton.addEventListener("click", () => {
                    // Remove the offer from the array
                    offers = offers.filter((_, i) => i !== index);

                    // Update the hidden input and the UI
                    updateOffersOverview();
                    offersHiddenInput.value = JSON.stringify(offers);
                });

                wrapper.appendChild(offerText);
                wrapper.appendChild(removeButton);
                offersOverview.appendChild(wrapper);
            });
        } else {
            offersOverview.innerHTML = "<p>No offers added yet.</p>";
        }
    }

    function previewImageWithRemove(input, previewContainerId) {
        const previewContainer = document.getElementById(previewContainerId);
        previewContainer.innerHTML = ""; // Clear existing preview
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement("div");
                wrapper.style.position = "relative";
                wrapper.style.display = "inline-block";

                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.width = "100px";
                img.style.height = "100px";
                img.style.objectFit = "cover";
                img.style.border = "1px solid #ccc";
                img.style.borderRadius = "5px";

                const removeButton = document.createElement("button");
                removeButton.innerHTML = "Remove";
                removeButton.style.position = "absolute";
                removeButton.style.top = "5px";
                removeButton.style.right = "5px";
                removeButton.style.backgroundColor = "red";
                removeButton.style.color = "white";
                removeButton.style.border = "none";
                removeButton.style.borderRadius = "3px";
                removeButton.style.cursor = "pointer";
                removeButton.addEventListener("click", () => {
                    previewContainer.innerHTML = ""; // Remove the preview
                    input.value = ""; // Clear the input
                });

                wrapper.appendChild(img);
                wrapper.appendChild(removeButton);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImagesWithRemove(input, previewContainerId) {
        const previewContainer = document.getElementById(previewContainerId);
        previewContainer.innerHTML = ""; // Clear existing preview
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const wrapper = document.createElement("div");
                    wrapper.style.position = "relative";
                    wrapper.style.marginRight = "10px";

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.width = "100px";
                    img.style.height = "100px";
                    img.style.objectFit = "cover";
                    img.style.border = "1px solid #ccc";
                    img.style.borderRadius = "5px";

                    const removeButton = document.createElement("button");
                    removeButton.innerHTML = "Remove";
                    removeButton.style.position = "absolute";
                    removeButton.style.top = "5px";
                    removeButton.style.right = "5px";
                    removeButton.style.backgroundColor = "red";
                    removeButton.style.color = "white";
                    removeButton.style.border = "none";
                    removeButton.style.borderRadius = "3px";
                    removeButton.style.cursor = "pointer";
                    removeButton.addEventListener("click", () => {
                        // Remove the wrapper for this image
                        wrapper.remove();

                        // Remove the file from the input
                        const dataTransfer = new DataTransfer();
                        const files = Array.from(input.files).filter((_, i) => i !== index);
                        files.forEach(file => dataTransfer.items.add(file));
                        input.files = dataTransfer.files;
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeButton);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }
    }


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
