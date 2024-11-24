<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        .btn-primary {
            display: inline-block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
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
        <li class="active"><a href="{{url('add_staff')}}"><i class="bi bi-person-add"></i>Add Staff Account</a></li>
        <li><a href="{{url('view_account')}}"><i class="bi bi-person-add"></i>View Users Accounts</a></li>
        <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
        <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>


            </li>
            
  </nav>

    <div class="form-container">
        <h1 class="form-title">Add New Category</h1>
        <form action="{{ url('add_category') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" required>
            </div>
            <button type="submit" class="btn-primary">Add Category</button>
        </form>
        <div class="back-link">
            <a href="{{ url('superadmin_home') }}">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
