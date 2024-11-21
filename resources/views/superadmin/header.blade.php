
<header class="header">   
  <nav class="navbar navbar-expand-lg">
    </div>
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header">
        <!-- Navbar Header--><a href="{{url('superadmin_home')}}" class="navbar-brand">
          <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary" >Super</strong><strong>Admin</strong></div>
          <div class="brand-text brand-sm"><strong class="text-primary">S</strong><strong>A</strong></div></a>
        <!-- Sidebar Toggle Btn-->
      </div>
      <div class="right-menu list-inline no-margin-bottom">    
        <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i class="icon-email"></i><span class="badge dashbg-1">5</span></a>
          <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#" class="dropdown-item message d-flex align-items-center">
              <div class="profile"><img src="admin/img/avatar-3.jpg" alt="..." class="img-fluid">
                <div class="status online"></div>
              </div>
              <div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
              <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                <div class="status away"></div>
              </div>
              <div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
              <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                <div class="status busy"></div>
              </div>
              <div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
              <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                <div class="status offline"></div>
              </div>
              <div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a></div>
        </div>
        
        
        
        <!-- Log out               -->
        <div class="list-inline-item logout" style="color: rgb(23, 92, 240)">   
          @if (Route::has('login'))

                      @auth
                          <x-app-layout>
                          </x-app-layout>
                      @else
                          <li class="nav-item" style="padding-right: 10px;">
                              <!-- Style like other nav links -->
                              <a class="nav-link" href="{{url('login')}}"  text-decoration: none;">Login</a>
                          </li>
                  
                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{url('register')}}"  text-decoration: none;">Register</a>
                              </li>
                          @endif
                      @endauth
                  
                  @endif
                       </div>
      </div>
    </div>
  </nav>
</header>