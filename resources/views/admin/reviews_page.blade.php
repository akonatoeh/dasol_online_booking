<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        /* General Styles for the Reviews Section */
        .reviews-container {
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding-left: 300px;
        }

        .reviews-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .reviews-header h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #1e49a1;
        }

        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }

        .table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
            color: #333;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .rating-badge {
            font-weight: bold;
            border-radius: 50px;
            padding: 5px 10px;
            color: white;
            background-color: #ffcc00; /* Default yellow */
        }

        .rating-badge[data-rating="1"] {
            background-color: #ff0000; /* Red */
        }

        .rating-badge[data-rating="2"] {
            background-color: #ff6600; /* Orange */
        }

        .rating-badge[data-rating="3"] {
            background-color: #ffcc00; /* Yellow */
        }

        .rating-badge[data-rating="4"] {
            background-color: #66cc33; /* Green */
        }

        .rating-badge[data-rating="5"] {
            background-color: #009900; /* Dark Green */
        }

        .comment-text {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .comment-text:hover {
            white-space: normal;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item .page-link {
            color: #007bff;
            border-radius: 50px;
            padding: 5px 15px;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            @include('admin.sidebar')
        </nav>
        <div class="container-fluid p-4">
            <div class="reviews-container">
                <div class="reviews-header">
                    <h2>Customer Reviews</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Booking Ticket</th>
                                <th>Type</th>
                                <th>Service Name</th>
                                <th>Item Type</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Submitted On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allReviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $review->booking_ticket }}</td>
                                <td>{{ $review->type }}</td>
                                <td>{{ $review->item_name }}</td>
                                <td>{{ $review->item_type }}</td>
                                <td>
                                    <span class="rating-badge" data-rating="{{ $review->rating }}">
                                        {{ $review->rating }} ★
                                    </span>
                                </td>
                                <td>
                                    <span class="comment-text" title="{{ $review->comment ?? 'No Comment' }}">
                                        {{ $review->comment ?? 'No Comment' }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="pagination-container">
                    {{ $allReviews->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
