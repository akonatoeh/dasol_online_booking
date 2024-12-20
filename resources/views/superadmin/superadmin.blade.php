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
      <li><a href="{{url('add_user')}}"><i class="bi bi-person-add"></i>Add Owner Account</a></li>
      <li><a href="{{url('category')}}"><i class="bi bi-person-add"></i>Categories</a></li>
      <li><a href="{{url('add_staff')}}"><i class="bi bi-person-add"></i>Add Staff Account</a></li>
      <li><a href="{{url('view_account')}}"><i class="bi bi-people"></i>View Users Accounts</a></li>
      <li><a href="{{url('business_owners')}}"> <i class="bi bi-building-check"></i>BUSINESS OWNERS</a></li>
      <li><a href="{{url('all_messages')}}"> <i class="bi bi-building-check"></i>MESSAGES</a></li>
      <li><a href="{{url('announcements')}}"> <i class="bi bi-building-check"></i>ANNOUNCEMENTS</a></li>
          </li>
          
</nav>
    
    @include('superadmin.body')
        
    @include('admin.footer')

  </body>
</html>


