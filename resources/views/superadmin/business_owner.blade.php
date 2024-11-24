<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        .main-content {
            margin-left: 300px; /* Adjust sidebar offset */
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            flex: 1 1 calc(25% - 20px); /* Ensures cards adjust dynamically to container size */
            max-width: 300px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Ensures the button aligns at the bottom */
            height: 100%; /* Makes all cards the same height */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }

        .card .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .card .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    @include('superadmin.header')

    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <!-- Sidebar Navigation -->
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
        <li class="active"><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
        <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>
        <li><a href="{{url('announcements')}}"> <i class="bi bi-building-check"></i>ANNOUNCEMENTS</a></li>
            </li>
            
  </nav>
      

        <div class="main-content">
            <div class="container">
                <div class="section-title">
                    Business Owners Detail
                </div>

                <div class="card-container">
                    @foreach($data as $user)
                        @if($user->usertype === 'admin') <!-- Ensure correct usertype -->
                            <div class="card">
                                <h3>{{ $user->business_name }}</h3>
                                <p><strong>ID:</strong> {{ $user->id }}</p>
                                <p><strong>Contact Person:</strong> {{ $user->name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Contact Number:</strong> {{ $user->phone }}</p>
                                <p><strong>Business Location:</strong> {{ $user->location }}</p>

                                <a href="{{ url('view_owner_details', $user->id) }}" class="btn">More Details</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
