<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
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
          <li class="active"><a href="{{url('superadmin_home')}}"> <i class="icon-home"></i>DASHBOARD</a></li>
              <li><a href="#room_dropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>ACCOUNTS</a>
                <ul id="room_dropdown" class="collapse list-unstyled ">
                  <li><a href="{{url('add_user')}}">Add Business Owner</a></li>
                  <li><a href="{{url('view_account')}}">View Accounts</a></li>
                </ul>
          <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
          <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>


              </li>
              
    </nav>
    
    @include('superadmin.body')
        
    @include('admin.footer')

  </body>
</html>


