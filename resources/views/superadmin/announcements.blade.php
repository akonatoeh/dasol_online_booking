<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('admin.css')

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        .container {
            max-width: 1400px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-left: 290px;
        }

        .container h1 {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        table th {
            background-color: #007bff;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions {
            display: flex;
            gap: 10px; /* Adds spacing between buttons */
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #ffffff;
        }

        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-primary-form {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary-form:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    @include('superadmin.header')

    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <!-- Sidebar Header-->
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
                <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>
                <li class="active"><a href="{{url('announcements')}}"> <i class="bi bi-building-check"></i>ANNOUNCEMENTS</a></li>
            </ul>
        </nav>
      
        <div class="container">
            <h1>Manage and Create Announcements</h1>

            <!-- Manage Announcements Section -->
            <table>
                <thead>
                    <tr>
                        <th>Created</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Target Audience</th>
                        <th>Expiry Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->created_at->format('Y-m-d') }}</td>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ $announcement->content }}</td>
                            <td>
                                @if($announcement->target_audience === 'users')
                                    Tourists
                                @elseif($announcement->target_audience === 'admin')
                                    Business Owners
                                @else
                                    {{ $announcement->target_audience }}
                                @endif
                            </td>
                            <td>{{ $announcement->expiry_date ?? 'No Expiry' }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('superadmin.announcement.edit', $announcement->id) }}" class="btn-primary">Edit</a>
                                    <form action="{{ route('superadmin.announcement.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No announcements available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Create Announcement Section -->
            <form action="{{ route('superadmin.announcement.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter announcement title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="5" placeholder="Enter announcement content" required></textarea>
                </div>
                <div class="form-group">
                    <label for="target_audience">Send To</label>
                    <select id="target_audience" name="target_audience" class="form-control" required>
                        <option value="user">Users</option>
                        <option value="admin">Business Owners</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" id="expiry_date" name="expiry_date" class="form-control">
                </div>
                <button type="submit" class="btn-primary-form">Create Announcement</button>
            </form>
        </div>
    </div>
    @include('admin.footer')
</body>
</html>
