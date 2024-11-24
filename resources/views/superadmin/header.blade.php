
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