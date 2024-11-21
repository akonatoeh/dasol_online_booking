<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">

      /* Table Styles */
      .table_deg {
          width: 100%; /* Make the table occupy the full width */
          margin: 20px auto; /* Center the table and add top margin */
          border-collapse: collapse; /* Remove default table spacing */
          background-color: #ffffff; /* White background */
          overflow: hidden;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Add a subtle shadow */
      }
  
      .th_deg {
          background-color: #007bff; /* Blue background for table headers */
          color: #ffffff; /* White text for headers */
          padding: 15px;
          font-weight: bold;
          text-transform: uppercase;
          border-bottom: 2px solid #0056b3; /* Add bottom border for header */
      }
  
      tr {
          border-bottom: 1px solid #e0e0e0; /* Light grey bottom border */
      }
  
      td {
          padding: 15px;
          color: #333333; /* Darker text for readability */
          text-align: center; /* Center align the text */
          word-wrap: break-word; /* Allow text to wrap within cells */
      }
  
      /* Add alternating row colors */
      tr:nth-child(even) {
          background-color: #f8f9fa; /* Light grey background for even rows */
      }
  
      tr:hover {
          background-color: #e9ecef; /* Slightly darker grey on hover */
      }
  
      /* Button Styles */
      .btn-danger {
          background-color: #dc3545; /* Standard red for danger button */
          color: #ffffff;
          border: none;
          padding: 8px 16px;
          border-radius: 5px;
          text-decoration: none;
          transition: background-color 0.3s ease;
          font-weight: bold;
      }
  
      .btn-danger:hover {
          background-color: #c82333; /* Darker red on hover */
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
        <li class="active"><a href="{{url('view_account')}}"><i class="bi bi-person-add"></i>View Users Accounts</a></li>
        <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
        <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>


            </li>
            
  </nav>
        
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <table class="table_deg">

                <tr>
                    <th class="th_deg">Account ID</th>
                    <th class="th_deg">Name</th>
                    <th class="th_deg">Email</th>
                    <th class="th_deg">Phone</th>
                    <th class="th_deg">User Type</th>
                    <th class="th_deg">Date created</th>
                    <th class="th_deg">Delete</th>
                </tr>

                @foreach ($data as $data)

                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->usertype}}</td>
                    <td>{{$data->created_at}}</td>
                    <td>
                        <a class="btn btn-danger" href="">Delete</a>
                    </td>
                </tr>
                                    
                @endforeach
            
            </table>

          </div>
        </div>
    </div>
    @include('admin.footer')

  </body>
</html>