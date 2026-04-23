<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"  >

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- todo: css/script -->
    <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/fonts/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/my-auth/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/js/perfect-scrollbar/perfect-scrollbar.css') }}">
    <script src="{{ asset('vendor/my-dashboard/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/my-dashboard/js/config.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- css:external --}}
    @stack('css-internal')
    @stack('css-external')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <style>
        /* ============================================
           MODERN UI OVERRIDES — Catering CMS
           ============================================ */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #667eea;
            --primary-dark: #5a6fd6;
            --gradient-primary: linear-gradient(135deg, #667eea, #764ba2);
            --sidebar-bg: linear-gradient(180deg, #1e1e2d, #2d2d44);
            --body-bg: #f0f2f5;
            --card-radius: 16px;
            --font: 'Inter', sans-serif;
        }

        a { text-decoration: none !important; }
        body, .layout-wrapper { font-family: var(--font) !important; }
        .layout-wrapper { background: var(--body-bg) !important; }
        .content-wrapper { background: var(--body-bg) !important; }

        /* ---- SIDEBAR ---- */
        .modern-sidebar,
        .layout-menu {
            background: linear-gradient(180deg, #1e1e2d 0%, #2d2d44 100%) !important;
            border-right: 1px solid rgba(255,255,255,0.06) !important;
        }
        .layout-menu .app-brand {
            padding: 20px 20px 12px !important;
        }
        .sidebar-brand-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: var(--gradient-primary);
            display: inline-flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(102,126,234,0.35);
            flex-shrink: 0;
        }
        .sidebar-brand-text {
            font-family: var(--font) !important;
            font-size: 17px !important; font-weight: 700 !important;
            color: #fff !important; letter-spacing: 2.5px;
            margin-left: 12px !important;
        }
        .sidebar-divider {
            height: 1px; margin: 0 20px 8px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }
        .layout-menu .menu-inner .menu-item .menu-link {
            color: rgba(255,255,255,0.65) !important;
            border-radius: 10px !important; margin: 2px 12px !important;
            padding: 10px 14px !important;
            transition: all 0.25s ease !important;
        }
        .layout-menu .menu-inner .menu-item .menu-link:hover {
            background: rgba(255,255,255,0.08) !important;
            color: #fff !important;
        }
        .layout-menu .menu-inner .menu-item.active > .menu-link,
        .layout-menu .menu-inner .menu-item.open > .menu-link {
            background: rgba(102,126,234,0.15) !important;
            color: #fff !important;
            border-left: 3px solid #667eea !important;
        }
        .layout-menu .menu-inner .menu-item .menu-icon { color: rgba(255,255,255,0.5) !important; }
        .layout-menu .menu-inner .menu-item.active .menu-icon,
        .layout-menu .menu-inner .menu-item.open .menu-icon { color: #667eea !important; }
        .layout-menu .menu-sub { background: transparent !important; }
        .layout-menu .menu-sub .menu-link { padding-left: 28px !important; font-size: 13px !important; }
        .menu-inner-shadow { display: none !important; }

        /* Sidebar user card */
        .sidebar-user-card {
            margin: 8px 16px; padding: 14px;
            background: rgba(255,255,255,0.06); border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-user-avatar { width: 40px; height: 40px; flex-shrink: 0; }
        .sidebar-user-avatar img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .sidebar-user-name {
            font-size: 13px; font-weight: 600; color: #fff; margin: 0;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-email {
            font-size: 11px; color: rgba(255,255,255,0.45);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;
        }
        .sidebar-logout-btn {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            width: 100%; padding: 10px; border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);
            font-size: 13px; font-weight: 500; text-decoration: none !important;
            transition: all 0.25s ease; background: transparent;
        }
        .sidebar-logout-btn:hover {
            background: rgba(231,76,60,0.15); border-color: rgba(231,76,60,0.4);
            color: #ff6b6b;
        }

        /* ---- NAVBAR ---- */
        .modern-navbar, #layout-navbar {
            background: #fff !important;
            border-bottom: 1px solid rgba(0,0,0,0.06) !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
        }
        .modern-search-wrapper {
            background: #f4f5f7; border-radius: 20px;
            padding: 2px 14px;
        }
        .modern-search-wrapper input { background: transparent !important; }
        .navbar-bell-wrapper {
            position: relative; display: inline-flex;
        }
        .navbar-user-greeting {
            font-size: 14px; font-weight: 500; color: #444;
        }
        .navbar-avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--gradient-primary); display: flex;
            align-items: center; justify-content: center;
        }
        .navbar-avatar-circle i { color: #fff !important; font-size: 18px !important; }
        .modern-dropdown {
            border-radius: 12px !important; border: 1px solid rgba(0,0,0,0.08) !important;
            box-shadow: 0 12px 40px rgba(0,0,0,0.12) !important;
            overflow: hidden;
        }
        .modern-dropdown .dropdown-item {
            padding: 10px 20px !important; font-size: 14px;
            transition: background 0.2s ease;
        }
        .modern-dropdown .dropdown-item:hover { background: #f4f5f7 !important; }

        /* ---- FOOTER ---- */
        .modern-footer, .content-footer {
            font-size: 13px !important; color: #999 !important;
            border-top: 1px solid rgba(0,0,0,0.06) !important;
            background: transparent !important;
        }
        .footer-brand { font-weight: 600; color: #555; }
        .footer-version {
            font-size: 11px; color: #aaa; background: #e9ecef;
            padding: 2px 10px; border-radius: 10px;
        }

        /* ---- CARDS ---- */
        .card, .modern-card {
            border: none !important; border-radius: var(--card-radius) !important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06) !important;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.08) !important; }

        /* ---- WELCOME CARD ---- */
        .welcome-card {
            background: var(--gradient-primary); border-radius: var(--card-radius);
            padding: 0; overflow: hidden;
            box-shadow: 0 8px 32px rgba(102,126,234,0.25);
        }
        .welcome-card-content {
            display: flex; align-items: center; justify-content: space-between;
            padding: 36px 40px; min-height: 180px;
        }
        .welcome-text h2 {
            font-size: 24px; font-weight: 700; color: #fff; margin-bottom: 8px;
        }
        .welcome-text p {
            font-size: 15px; color: rgba(255,255,255,0.75); margin-bottom: 20px;
        }
        .welcome-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 22px; border-radius: 10px;
            background: rgba(255,255,255,0.2); color: #fff;
            font-size: 14px; font-weight: 600; text-decoration: none !important;
            backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.25);
            transition: all 0.25s ease;
        }
        .welcome-btn:hover {
            background: rgba(255,255,255,0.3); transform: translateY(-1px);
            color: #fff;
        }
        .welcome-illustration { flex-shrink: 0; opacity: 0.6; }

        /* ---- STAT CARDS ---- */
        .stat-card {
            background: #fff; border-radius: var(--card-radius);
            box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden;
            transition: all 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .stat-card-body {
            display: flex; align-items: center; gap: 16px; padding: 22px 24px;
        }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-icon i { font-size: 24px; color: #fff; }
        .stat-card-primary .stat-icon { background: linear-gradient(135deg, #667eea, #764ba2); }
        .stat-card-success .stat-icon { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .stat-card-info .stat-icon { background: linear-gradient(135deg, #00b4d8, #0077b6); }
        .stat-card-warning .stat-icon { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .stat-label { font-size: 12px; color: #999; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-value { font-size: 22px; font-weight: 700; color: #2d3436; margin: 4px 0 0; }
        .stat-footer {
            padding: 10px 24px; border-top: 1px solid #f0f0f0;
            font-size: 12px; color: #aaa; display: flex; align-items: center; gap: 4px;
        }

        /* ---- QUICK ACTIONS ---- */
        .modern-card-title {
            font-size: 16px; font-weight: 600; color: #333;
            display: flex; align-items: center; gap: 8px; margin-bottom: 20px;
        }
        .modern-card-title i { color: var(--primary); }
        .quick-actions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .quick-action-item {
            display: flex; flex-direction: column; align-items: center; gap: 8px;
            padding: 20px 12px; border-radius: 12px; background: #f8f9fb;
            text-decoration: none !important; color: #555; font-size: 13px; font-weight: 500;
            transition: all 0.25s ease;
        }
        .quick-action-item:hover { background: #eef0f5; transform: translateY(-2px); color: #333; }
        .quick-action-icon {
            width: 42px; height: 42px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .quick-action-icon i { font-size: 20px; color: #fff; }
        .qa-primary { background: var(--gradient-primary); }
        .qa-success { background: linear-gradient(135deg, #2ecc71, #27ae60); }

        /* ---- SYSTEM INFO ---- */
        .system-info-list { display: flex; flex-direction: column; gap: 14px; }
        .system-info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding-bottom: 12px; border-bottom: 1px solid #f0f0f0;
        }
        .system-info-row:last-child { border-bottom: none; padding-bottom: 0; }
        .system-info-label { font-size: 13px; color: #888; }
        .system-info-value { font-size: 13px; font-weight: 600; color: #333; }
        .env-badge {
            background: #e8f5e9; color: #2e7d32; padding: 3px 12px;
            border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: uppercase;
        }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 768px) {
            .welcome-card-content { flex-direction: column; text-align: center; padding: 28px 24px; }
            .welcome-illustration { display: none; }
            .quick-actions-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('admin.layouts.components.sidebar')
            <div class="layout-page">
                @include('admin.layouts.components.navbar')
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="toast-new"></div>

                        @yield('breadcrumbs')
                        @yield('content')
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    @include('admin.layouts.components.footer')
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
        </div>
    </div>

     <!-- scripts -->
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="{{ asset('vendor/my-dashboard/js/jquery/jquery.js') }}"></script>
  <script src="{{ asset('vendor/my-dashboard/js/bootstrap.js') }}"></script>
  <script src="{{ asset('vendor/my-dashboard/js/popper/popper.js') }}"></script>
  <script src="{{ asset('vendor/my-dashboard/js/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('vendor/my-dashboard/js/menu.js') }}"></script>
  <script src="{{ asset('vendor/my-dashboard/js/apex-charts/apexcharts.js') }}"></script>
  <script src="{{ asset('vendor/my-dashboard/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- <script src="{{asset('js/app.js')}}"></script> -->

  {{-- sweet alert --}}
   @include('sweetalert::alert') 
  {{-- javascript:external --}}
  @stack('javascript-external')
  @stack('javascript-internal')


  <script>
    let base_url = window.location.origin;

    $('.updateSkor').on('click', function() {
      $.ajax({
        url: `${base_url}/admin/updateScore`,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(xhr, error) {
          if (xhr.status === 500) {}
        },
        success: (response) => {
          // console.log(response);
          location.reload()
        }
      })
    })

    

    $('.close-notif').on('click', function() {
      let close = $(this).attr('data-close');


      $.ajax({
        url: `${base_url}/notification-close/${close}`,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(xhr, error) {
          if (xhr.status === 500) {}
        },
        success: (response) => {
          $('.badge-notif').empty()
          $('.badge-notif').text(response[1])

          let itemList = $(`.item-notif-list-${close}`)
          itemList.remove()
        }
      })


    })

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dcfca9ae57e3fd3cee06', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('messages');
    channel.bind("App\\Events\\MessageCreated", function(data) {
      // alert(JSON.stringify(data));
      let datas = JSON.stringify(data.pos_invoice)
      var result = datas.slice(1, -1);

      $.ajax({
        url: `${base_url}/notifications`,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(xhr, error) {
          if (xhr.status === 500) {}
        },
        success: (response) => {
          $('.badge-notif').empty()
          $('.badge-notif').append(response[1])
          for (let i = 0; i <= response[0].length; i++) {
            $('.list-group').append(`
                        <li class="list-group-item list-group-item-action dropdown-notifications-item item-notif-list-${response[0][i].id}">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">Pembayaran Diterima🎉</h6>
                                <p class="mb-0">${response[0][i].name}</p>
                                <small class="text-muted">${response[0][i].time}</small>
                              
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive close-notif" data-toggle="tooltip" data-placement="right" title="Click to make this notifications read" data-close="${response[0][i].id}" ><span class="bx bx-x"></span></a>
                              </div>
                            </div>
                          </li>
                        `)
          }
        }
      })
    });
  </script>

    {{--
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
    {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
    </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    </div>
    --}}


</body>

</html>