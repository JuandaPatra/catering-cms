@extends('admin.layouts.layouts')

@section('content')
<!-- Welcome Card -->
<div class="row mb-4">
  <div class="col-12">
    <div class="welcome-card">
      <div class="welcome-card-content">
        <div class="welcome-text">
          <h2>Welcome back, {{Auth::user()->name}}! 👋</h2>
          <p>Here's what's happening with your catering business today.</p>
          <a href="{{route('invoice.create')}}" class="welcome-btn">
            <i class="bx bx-plus"></i> Create Invoice
          </a>
        </div>
        <div class="welcome-illustration">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="160" height="160">
            <circle cx="100" cy="100" r="80" fill="rgba(255,255,255,0.1)" />
            <circle cx="100" cy="100" r="55" fill="rgba(255,255,255,0.08)" />
            <path d="M90 70h-8v28H74V70h-8v28c0 8.48 6.64 15.36 15 15.88V140h10v-26.12c8.36-.52 15-7.4 15-15.88V70h-8v28h-8V70z" fill="rgba(255,255,255,0.7)"/>
            <path d="M124 62v32h10v32h12V54c-11.04 0-22 3.58-22 8z" fill="rgba(255,255,255,0.5)"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Stats Row -->
<div class="row mb-4">
  <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
    <div class="stat-card stat-card-primary">
      <div class="stat-card-body">
        <div class="stat-icon">
          <i class="bx bx-receipt"></i>
        </div>
        <div class="stat-info">
          <span class="stat-label">Total Invoices</span>
          <h3 class="stat-value">—</h3>
        </div>
      </div>
      <div class="stat-footer">
        <i class="bx bx-trending-up"></i> <span>View all</span>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
    <div class="stat-card stat-card-success">
      <div class="stat-card-body">
        <div class="stat-icon">
          <i class="bx bx-wallet"></i>
        </div>
        <div class="stat-info">
          <span class="stat-label">Revenue</span>
          <h3 class="stat-value">—</h3>
        </div>
      </div>
      <div class="stat-footer">
        <i class="bx bx-bar-chart-alt-2"></i> <span>This month</span>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
    <div class="stat-card stat-card-info">
      <div class="stat-card-body">
        <div class="stat-icon">
          <i class="bx bx-user-check"></i>
        </div>
        <div class="stat-info">
          <span class="stat-label">Customers</span>
          <h3 class="stat-value">—</h3>
        </div>
      </div>
      <div class="stat-footer">
        <i class="bx bx-group"></i> <span>Active</span>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
    <div class="stat-card stat-card-warning">
      <div class="stat-card-body">
        <div class="stat-icon">
          <i class="bx bx-package"></i>
        </div>
        <div class="stat-info">
          <span class="stat-label">Products</span>
          <h3 class="stat-value">—</h3>
        </div>
      </div>
      <div class="stat-footer">
        <i class="bx bx-food-menu"></i> <span>Menu items</span>
      </div>
    </div>
  </div>
</div>

<!-- Quick Actions -->
<div class="row">
  <div class="col-md-6 mb-4">
    <div class="card modern-card">
      <div class="card-body">
        <h5 class="modern-card-title"><i class="bx bx-zap"></i> Quick Actions</h5>
        <div class="quick-actions-grid">
          <a href="{{route('invoice.create')}}" class="quick-action-item">
            <div class="quick-action-icon qa-primary"><i class="bx bx-plus-circle"></i></div>
            <span>New Invoice</span>
          </a>
          <a href="{{route('invoice.index')}}" class="quick-action-item">
            <div class="quick-action-icon qa-success"><i class="bx bx-list-ul"></i></div>
            <span>All Invoices</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-4">
    <div class="card modern-card">
      <div class="card-body">
        <h5 class="modern-card-title"><i class="bx bx-info-circle"></i> System Info</h5>
        <div class="system-info-list">
          <div class="system-info-row">
            <span class="system-info-label">Application</span>
            <span class="system-info-value">{{ config('app.name', 'Catering CMS') }}</span>
          </div>
          <div class="system-info-row">
            <span class="system-info-label">User</span>
            <span class="system-info-value">{{Auth::user()->email}}</span>
          </div>
          <div class="system-info-row">
            <span class="system-info-label">Environment</span>
            <span class="system-info-value"><span class="env-badge">{{ config('app.env', 'production') }}</span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
