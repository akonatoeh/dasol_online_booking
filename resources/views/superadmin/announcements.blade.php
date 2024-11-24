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
            <ul class="list-unstyled">
                <li><a href="{{url('superadmin_home')}}"> <i class="icon-home"></i>DASHBOARD</a></li>
                <li  class="active"><a href="{{url('add_user')}}"><i class="bi bi-person-add"></i>Add Owner Account</a></li>
                <li><a href="{{url('add_staff')}}"><i class="bi bi-person-add"></i>Add Staff Account</a></li>
                <li><a href="{{url('view_account')}}"><i class="bi bi-person-add"></i>View Users Accounts</a></li>
                <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
                <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>
        
        
                    </li>
                    
          </nav>
    @include('superadmin.announcements')

    @include('admin.footer')
</body>
</html>
