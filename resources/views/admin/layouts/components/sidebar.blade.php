<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme modern-sidebar">
  <div class="app-brand demo">
    <a href="{{route('admin.dashboard')}}" class="app-brand-link no-underline" style="text-decoration:none;">
      <span class="sidebar-brand-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#fff">
          <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
        </svg>
      </span>
      <span class="sidebar-brand-text">CATERING</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="sidebar-divider"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item  {{ set_active(['invoice.index','invoice.create', 'invoice.edit']) }} {{ set_open(['invoice.index','invoice.create', 'invoice.edit']) }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon bx bx-carousel"></i>
        <div data-i18n="Layouts">Invoice</div>
      </a>
      <ul class="menu-sub active">
        <li class="menu-item {{ set_active('invoice.index') }}">
          <a href="{{route('invoice.index')}}" class="menu-link">
            <div data-i18n="Without menu" style="margin-left:1.5rem">List</div>
          </a>
        </li>
        <li class="menu-item {{ set_active('invoice.create') }}">
          <a href="{{route('invoice.create')}}" class="menu-link">
            <div data-i18n="Without navbar" style="margin-left:1.5rem">Buat</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>

    <footer>
      <div class="sidebar-user-card">
          <div class="d-flex align-items-center">
            <div class="sidebar-user-avatar">
              <img src="{{ asset('images/logo.jpeg') }}" alt="Avatar">
            </div>
            <div class="ms-3" style="overflow:hidden;">
              <h6 class="sidebar-user-name">{{Auth::user()->name}}</h6>
              <span class="sidebar-user-email">{{Auth::user()->email}}</span>
            </div>
          </div>
        </div>
        <div style="margin: 0 16px 16px;">
          <a href="{{ route('logout') }}" class="sidebar-logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bx bx-log-out"></i> Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
  </footer>
</aside>
<!-- / Menu -->
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>