<!DOCTYPE html>
<html>
<head>
    @include('admin.css')

    <style type="text/css">
        /* Form Container Styles */
        .form-container {
            max-width: 700px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #007bff; /* Blue color for the header */
            margin-bottom: 20px;
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: calc(100% - 20px);
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f8f9fa;
            transition: border-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Button Styles */
        .form-actions {
            text-align: center;
            margin-top: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 50%;
            text-align: center;
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
            <!-- Sidebar Navigation Menus-->
            <span class="heading"></span>
            <ul class="list-unstyled">
          <li ><a href="{{url('superadmin_home')}}"> <i class="icon-home"></i>DASHBOARD </a></li>
                <li class="active"><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-windows"></i>ACCOUNT</a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('add_user') }}">Add Business Owner</a></li>
                        <li><a href="{{ url('view_account') }}">View Accounts</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <!-- Form Layout -->
                    <div class="form-container">
                        <h1>Add User</h1>
                        <form action="{{ url('add.user') }}" method="POST">
                            @csrf
                            <!-- Name Input -->
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" name="name" required>
                            </div>

                            <!-- Name Input -->
                            <div class="form-group">
                                <label>Bussiness Name</label>
                                <input type="text" name="business_name" required>
                            </div>

                            <!-- Email Input -->
                            <div class="form-group">
                                <label>Business Email</label>
                                <input type="email" name="email" required>
                            </div>

                            <!-- Phone Input -->
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" name="phone" pattern="[0-9]{11}" required placeholder="Enter 11-digit phone number">
                            </div>

                            <!-- Usertype Selection -->
                            <div class="form-group">
                                <label>User Type</label>
                                <select name="usertype" required>
                                    <option value="user">User</option>
                                    <option value="admin">Bussiness Owner</option>
                                    <option value="superadmin">Super Admin</option>
                                </select>
                            </div>

                            <!-- Password Input -->
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" required minlength="8" placeholder="Enter at least 8 characters">
                            </div>

                            <!-- Submit Button -->
                            <div class="form-actions">
                                <button class="btn-primary" type="submit">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
