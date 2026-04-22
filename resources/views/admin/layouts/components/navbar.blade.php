<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>

    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->
      <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
        <a class="nav-link dropdown-toggle hide-arrow hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
          <i class="bx bx-bell bx-sm"></i>
          {{--
            <span class="badge bg-danger rounded-pill badge-notif">@if($notificationsCount != 0) {{$notificationsCount}} @endif</span>
             --}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end py-0 hide-arrow" data-bs-popper="static">
          <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
              <h5 class="text-body mb-0 me-auto">Notification</h5>
              <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read" data-bs-original-title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
            </div>
          </li>
          <li class="dropdown-notifications-list scrollable-container ps">
            <ul class="list-group list-group-flush" style="width:300px;">
                {{-- 
                    @foreach($notifications as $notification)
                    <li class="list-group-item list-group-item-action dropdown-notifications-item item-notif-list-{{$notification->id}} cursor-pointer">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1">Pembayaran Diterima🎉</h6>
                          <p class="mb-0">{{$notification->name}}</p>
                          <div>
                            <a href="{{route('notifications.to', $notification->id)}}" >check detail</a>
                          </div>
                          <small class="text-muted">{{$notification->time}}</small>
                         
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive close-notif" data-toggle="tooltip" data-placement="right" title="Click to make this notifications read" data-close="{{$notification->id}}" ><span class="bx bx-x"></span></a>
                        </div>
                      </div>
                    </li>
                    @endforeach
                    --}}
             
            </ul>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
              <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
          </li>
          <li class="dropdown-menu-footer border-top">
            <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40">
              View all notifications
            </a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item lh-1 me-3">
        
            <a class="github-button" href="" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">{{Auth::user()->name}} </a>
            


      </li>


      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <i class="bx bx-user-circle  bx-md"></i>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <i class="bx bx-user-circle  bx-md"></i>
                  </div>
                </div>
                 
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                      <small class="text-muted">{{Auth::user()->name}}</small>
                    </div>
                    
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <!-- <a class="dropdown-item" href="">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
          </a> -->
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>

<!-- / Navbar -->