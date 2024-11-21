<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        .main-content {
            margin-left: 300px; /* Adjust this value to shift content more to the right */
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
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
    <li><a href="{{url('add_staff')}}"><i class="bi bi-person-add"></i>Add Staff Account</a></li>
    <li><a href="{{url('view_account')}}"><i class="bi bi-person-add"></i>View Users Accounts</a></li>
    <li class="active"><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
    <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>


        </li>
        
</nav>

        <div class="main-content">
            <div class="container">
                <div class="section-title">Business Owner Details</div>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Role</th>
                            <th>Date/Time</th>
                            <th>More Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- Replace with dynamic content -->
                        <tr>
                            <td>3189</td>
                            <td>Tambobong</td>
                            <td>tambobong@gmail.com</td>
                            <td>Dasol Pangasinan</td>
                            <td>tambobong@gmail.com</td>
                            <td>17272727273</td>
                            <td>Business Owner</td>
                            <td>2024-11-20 04:13:47</td>
                            <td><button class="btn btn-primary">More Details</button></td>


                        </tr>
                        <tr>
                            <td>5032</td>
                            <td>Summer Scent</td>
                            <td>summerscent@gmail.com</td>
                            <td>Dasol Pangasinan</td>
                            <td>tambobong@gmail.com</td>
                            <td>12342521452</td>
                            <td>Business Owner</td>
                            <td>2024-11-20 04:09:37</td>
                            <td><button class="btn btn-primary">More Details</button></td>

                        </tr>
                        <tr>
                            <td>7047</td>
                            <td>Cabanas Beach</td>
                            <td>cabanasresort@gmail.com</td>
                            <td>Dasol Pangasinan</td>
                            <td>tambobong@gmail.com</td>
                            <td>09666229219</td>
                            <td>Business Owner</td>
                            <td>2024-11-20 04:09:04</td>
                            <td><button class="btn btn-primary">More Details</button></td>


                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
