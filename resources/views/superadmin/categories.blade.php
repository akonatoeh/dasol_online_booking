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

        .container {
            margin: auto;
            padding: 20px;
            max-width: 1200px;
            margin-left: 350px;
        }

        /* Form Styles */
        .form-container {
            max-width: 600px;
            margin: 20px auto;
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

        /* Table Styles */
        .categories-container {
            margin-top: 30px;
        }

        .categories-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .categories-table th, .categories-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        .categories-table th {
            background-color: #007bff;
            color: #ffffff;
        }

        .categories-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-btn {
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
        <li class="active"><a href="{{url('category')}}"><i class="bi bi-person-add"></i>Categories</a></li>
        <li><a href="{{url('add_staff')}}"><i class="bi bi-person-add"></i>Add Staff Account</a></li>
        <li><a href="{{url('view_account')}}"><i class="bi bi-people"></i>View Users Accounts</a></li>
        <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
        <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>
        <li><a href="{{url('announcements')}}"> <i class="bi bi-building-check"></i>ANNOUNCEMENTS</a></li>
            </li>
            
  </nav>

        <div class="container">
            <!-- Form to Add New Category -->
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
            </div>

            <!-- Categories List -->
            <div class="categories-container">
                <h2 class="form-title">Categories List</h2>
                @if($categories->isEmpty())
                    <p class="no-data">No categories available.</p>
                @else
                    <table class="categories-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <button class="action-btn btn-edit" onclick="openModal({{ $category->id }}, '{{ $category->name }}')">Edit</button>
                                        <form action="{{ url('delete_category', $category->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 class="form-title">Edit Category</h2>
            <form id="editCategoryForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_category_name">Category Name</label>
                    <input type="text" class="form-control" id="edit_category_name" name="category_name" required>
                </div>
                <button type="submit" class="btn-primary">Update Category</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, name) {
            const form = document.getElementById('editCategoryForm');
            form.action = `/update_category/${id}`;
            document.getElementById('edit_category_name').value = name;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
