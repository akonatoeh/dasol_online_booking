<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Contacts</title>
    @include('admin.css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-left: 300px; /* Align to the right */
            
        }

        .title {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 12px;
        }

        table th {
            background-color: #2c3e50;
            color: #ffffff;
            font-weight: bold;
            text-align: left;
            padding: 12px;
        }

        table td {
            background-color: #ffffff;
            color: #555;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        table tr:hover td {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            color: #999;
            font-size: 18px;
            padding: 20px;
        }

        .button-container {
            text-align: right;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #3498db;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
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
                    <li><a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ACCOUNTS</a>
                      <ul id="room_dropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('add_user')}}">Add Business Owner</a></li>
                        <li><a href="{{url('view_account')}}">View Accounts</a></li>
                      </ul>
                <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
                <li  class="active"><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>
       </li>
                    
          </nav>

    <div class="container">
        <h1 class="title">User Contacts</h1>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="no-data">No messages available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="button-container">
            <a href="{{ url('superadmin_home') }}" class="btn">Back to Dashboard</a>
        </div>
    </div>
  </body>
</html>
