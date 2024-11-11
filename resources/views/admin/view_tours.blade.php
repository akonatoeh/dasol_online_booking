<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style type="text/css">
        /* Table Styles */
        .table_deg {
            width: 100%;
            margin: 40px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .th_deg {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #0056b3;
            white-space: nowrap;
        }

        tr {
            border-bottom: 1px solid #e0e0e0;
        }

        td {
            padding: 15px;
            color: #333333;
            text-align: center;
        }

        td:nth-child(2) {
            width: 30%;
            text-align: left;
            white-space: normal;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .room-image {
            width: 100px;
            border-radius: 5px;
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
            padding-top: 40px; /* Adds extra space at the top to avoid text overlap with the close button */
            border-radius: 8px;
            max-width: 60%;
            max-height: 80%;
            overflow-y: auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: left;
            position: relative;
        }

        .close-inside-modal {
    position: absolute; /* Changed to absolute to prevent stretching */
    top: 10px;
    right: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #ffffff;
    background-color: #ff3333;
    border: none;
    border-radius: 50%; /* Ensures circular shape */
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
    z-index: 10;
}

.close-inside-modal:hover {
    background-color: #ff6666;
}

        .view-more-btn,
        .read-more-btn {
            color: #007bff;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            background: none;
            border: none;
            text-decoration: underline;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .pagination button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            margin: 0 5px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination button:hover {
            background-color: #0056b3;
        }

        .pagination button.active {
            background-color: #0056b3;
        }

        .pagination input {
            width: 50px;
            margin-left: 10px;
            padding: 6px;
            border-radius: 4px;
            border: 1px solid #ddd;
            text-align: center;
        }
    </style>
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
                <li><a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ROOMS</a>
                    <ul id="room_dropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('create_room')}}">Add Rooms</a></li>
                        <li><a href="{{url('view_room')}}">View Rooms</a></li>
                    </ul>
                </li>
                <li class="active"><a href="#tours_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>TOURS & ACTIVITIES</a>
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
                    <h1 class="form-title">Add Activities</h1>
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
                                        <button class="read-more-btn" data-description="{{ $data->description }}" onclick="showDescriptionModal(this)">Read More</button>
                                    </td>
                                    <td>{{ $data->location }}</td>
                                    <td>{{ $data->price }}₱</td>
                                    <td>{{ $data->type }}</td>
                                    <td>{{ $data->contacts }}</td>
                                    <td>
                                        <ul>
                                            @foreach($data->availabilities->take(3) as $availability)
                                                <li>{{ \Carbon\Carbon::parse($availability->available_date)->format('Y-m-d') }}</li>
                                            @endforeach
                                            @if ($data->availabilities->count() > 3)
                                                <button class="view-more-btn" data-dates="{{ $data->availabilities->pluck('available_date')->implode(', ') }}" onclick="showDatesModal(this)">View More</button>
                                            @endif
                                        </ul>
                                    </td>
                                    <td><img src="tours_activities/{{ $data->image }}" class="activity-image" alt="Activity Image"></td>
                                    <td><a class="btn btn-warning" href="{{url('update_activities', $data->id)}}">Update</a></td>
                                    <td><a onclick="return confirm('Are you sure to delete this?');" class="btn btn-danger" href="{{url('activity_delete', $data->id)}}">Delete</a></td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                <!-- Pagination container moved here, below the table -->
                <div class="pagination">
                    <button id="prevPage">Previous</button>
                    <div id="paginationButtons"></div>
                    <button id="nextPage">Next</button>
                    <span>Jump to page:</span>
                    <input type="number" id="jumpToPage" min="1" placeholder="Page #">
                    <button id="jumpButton">Go</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Modal -->
    <div id="descriptionModal" class="modal-overlay">
        <div class="modal-content">
            <button class="close-inside-modal" onclick="closeModal('descriptionModal')">×</button>
            <div id="descriptionContent"></div>
        </div>
    </div>

    <!-- Dates Modal -->
    <div id="datesModal" class="modal-overlay">
        <div class="modal-content">
            <button class="close-inside-modal" onclick="closeModal('datesModal')">×</button>
            <div id="datesContent"></div>
        </div>
    </div>

    <script>
function showDescriptionModal(button) {
    const description = button.getAttribute('data-description');
    document.getElementById('descriptionContent').textContent = description;
    document.getElementById('descriptionModal').style.display = 'flex';
}

function showDatesModal(button) {
    const dates = button.getAttribute('data-dates').split(', ');
    document.getElementById('datesContent').innerHTML = dates.map(date => `<p>${date}</p>`).join('');
    document.getElementById('datesModal').style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Pagination
document.addEventListener("DOMContentLoaded", function() {
    const rowsPerPage = 5;
    const rows = document.querySelectorAll(".table_deg tbody tr");
    const totalRows = rows.length;
    const pageCount = Math.ceil(totalRows / rowsPerPage);
    const paginationButtonsContainer = document.getElementById("paginationButtons");
    let currentPage = 1;

    function displayRowsForPage(page) {
        rows.forEach((row, index) => {
            row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? "" : "none";
        });
    }

    function createPaginationButton(page) {
        const button = document.createElement("button");
        button.textContent = page;
        button.classList.toggle("active", page === currentPage);
        button.addEventListener("click", () => {
            currentPage = page;
            displayRowsForPage(page);
            updatePagination();
        });
        return button;
    }

    function updatePagination() {
        paginationButtonsContainer.innerHTML = ""; // Clear pagination buttons
        for (let i = 1; i <= pageCount; i++) {
            const button = createPaginationButton(i);
            paginationButtonsContainer.appendChild(button);
        }
    }

    // Next and Previous buttons
    document.getElementById("nextPage").addEventListener("click", () => {
        if (currentPage < pageCount) {
            currentPage++;
            displayRowsForPage(currentPage);
            updatePagination();
        }
    });

    document.getElementById("prevPage").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayRowsForPage(currentPage);
            updatePagination();
        }
    });

    // Jump to page
    document.getElementById("jumpButton").addEventListener("click", () => {
        const pageInput = document.getElementById("jumpToPage").value;
        let page = parseInt(pageInput);

        // Default to page 1 if input is empty, invalid, or out of range
        if (isNaN(page) || page < 1) {
            page = 1;
        } else if (page > pageCount) {
            page = pageCount;
        }

        currentPage = page;
        displayRowsForPage(page);
        updatePagination();
    });

    displayRowsForPage(1); // Display the first page initially
    updatePagination(); // Set up pagination buttons
});
</script>
</div>

@include('admin.footer')
</body>
</html>