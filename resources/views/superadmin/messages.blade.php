<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        /* Isolating the container styles */
        .content-container {
            max-width: 1800px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            flex: 1; /* Allow the container to grow and fill available space */
            margin-left: 300px;
        }

        .content-container h1 {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        .content-container table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #fff;
        }

        .content-container table th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #dee2e6;
        }

        .content-container table td {
            padding: 12px;
            color: #555;
            border-bottom: 1px solid #eee;
        }

        .content-container table tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .content-container table tr:nth-child(even) {
            background-color: #ffffff;
        }

        .content-container table tr:hover {
            background-color: #f1f8ff;
        }

        .content-container .status {
            font-weight: bold;
            text-align: center;
        }

        .content-container .status.in-stock {
            color: #28a745; /* Green for in-stock */
        }

        .content-container .status.backorder {
            color: #007bff; /* Red for backorder */
        }

        .content-container .action-btn {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .content-container .action-btn:hover {
            background-color: #0056b3;
        }

        .content-container .no-data {
            text-align: center;
            font-size: 18px;
            color: #999;
            padding: 20px;
        }
    </style>
</head>
<body>
    @include('superadmin.header')

    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="title">
                    <h1 class="h5">{{ Auth::user()->name }}</h1>
                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading"></span>
            <ul class="list-unstyled">
                <li><a href="{{url('superadmin_home')}}"> <i class="icon-home"></i>DASHBOARD</a></li>
                <li><a href="{{url('add_user')}}"><i class="bi bi-person-add"></i>Add Owner Account</a></li>
                <li><a href="{{url('category')}}"><i class="bi bi-person-add"></i>Categories</a></li>
                <li><a href="{{url('add_staff')}}"><i class="bi bi-person-add"></i>Add Staff Account</a></li>
                <li><a href="{{url('view_account')}}"><i class="bi bi-people"></i>View Users Accounts</a></li>
                <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
                <li class="active"><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>
                <li><a href="{{url('announcements')}}"> <i class="bi bi-building-check"></i>ANNOUNCEMENTS</a></li>
            </ul>
        </nav>
      
        <div class="content-container">
            <h1 class="title">User Contacts</h1>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contact as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->message }}</td>
                            <td class="status">
                                <a href="#" class="action-btn">Message Back</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="no-data">No messages available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
