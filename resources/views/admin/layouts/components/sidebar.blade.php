<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{route('admin.dashboard')}}" class="app-brand-link no-underline">
      <span class="app-brand-logo demo">

      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">CATERING</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    {{--
    <!-- Dashboard -->
    <li class="menu-item ">
      <a href="" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
  --}}

    <li class="menu-item  {{ set_active(['invoice.index','invoice.create', 'invoice.edit']) }} {{ set_open(['invoice.index','invoice.create', 'invoice.edit']) }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon bx bx-carousel"></i>
        <div data-i18n="Layouts">Invoice</div>
      </a>
      <ul class="menu-sub active">
        <li class="menu-item {{ set_active('invoice.index') }}">
          <a href="{{route('invoice.index')}}" class="menu-link">
            <div data-i18n="Without menu">List</div>
          </a>
        </li>
        <li class="menu-item {{ set_active('invoice.create') }}">
          <a href="{{route('invoice.create')}}" class="menu-link">
            <div data-i18n="Without navbar">Buat</div>
          </a>
        </li>
      </ul>
    </li>









  </ul>

    <footer>
      <div class="card-body menu-toggle-footer d-flex justify-content-center" style="margin: 0rem 1rem;">
          <div class="d-flex align-items-center justify-content-center">
            <div class="avatar avatar-lg">
              <img src="{{ asset('images/logo.jpeg') }}" alt="Avatar" class="rounded-circle">
            </div>
            <div class="ms-3">
              <h5 class="mb-0">{{Auth::user()->name}}</h5>
              <span class="text-muted">{{Auth::user()->email}}</span>
            </div>
          </div>
        </div>
        <div style="margin: 10px;">
          <a href="{{ route('logout') }}" class="btn btn-outline-primary w-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
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