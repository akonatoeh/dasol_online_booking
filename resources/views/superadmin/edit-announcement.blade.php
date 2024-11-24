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
            margin: 40px auto;
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
            color: #007bff; /* Blue color for the header */
            margin-bottom: 20px;
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

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #ffffff;
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-primary, .btn-secondary {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            margin-bottom: 20px;
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
            <h1>Edit Announcement</h1>

            <!-- Back Button -->
            <a href="{{ route('superadmin.announcements') }}" class="btn-secondary">Back</a>

            <form action="{{ route('superadmin.announcement.update', $announcement->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $announcement->title }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="5" required>{{ $announcement->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="{{ $announcement->expiry_date }}">
                </div>

                <button type="submit" class="btn-primary">Update Announcement</button>
            </form>
        </div>
    </div>
</body>
</html>
