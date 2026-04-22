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

    <li class="menu-item  active">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon bx bx-carousel"></i>
        <div data-i18n="Layouts">Invoice</div>
      </a>
      <ul class="menu-sub active">
        <li class="menu-item ">
          <a href="{{route('invoice.index')}}" class="menu-link">
            <div data-i18n="Without menu">List</div>
          </a>
        </li>
        <li class="menu-item active">
          <a href="{{route('invoice.create')}}" class="menu-link">
            <div data-i18n="Without navbar">Buat</div>
          </a>
        </li>
      </ul>
    </li>









  </ul>
</aside>
<!-- / Menu -->
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>