<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Quản trị')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #1a1a2e; width: 240px; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar .nav-link { color: #adb5bd; padding: 10px 20px; border-radius: 6px; margin: 2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #16213e; color: #fff; }
        .sidebar .brand { color: #ffc107; font-weight: bold; font-size: 1.1rem; padding: 20px; border-bottom: 1px solid #333; }
        .main-content { margin-left: 240px; padding: 20px; }
        .topbar { background: #fff; padding: 12px 20px; border-bottom: 1px solid #dee2e6; margin: -20px -20px 20px; }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column">
    <div class="brand"><i class="bi bi-geo-alt-fill"></i> HG Admin</div>
    <nav class="nav flex-column mt-2">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('admin.destinations*') ? 'active' : '' }}" href="{{ route('admin.destinations.index') }}">
            <i class="bi bi-geo-alt me-2"></i> Điểm du lịch
        </a>
        <a class="nav-link {{ request()->routeIs('admin.households*') ? 'active' : '' }}" href="{{ route('admin.households.index') }}">
            <i class="bi bi-house-heart me-2"></i> Hộ dân
        </a>
        <a class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
            <i class="bi bi-grid me-2"></i> Dịch vụ
        </a>
        <a class="nav-link {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
            <i class="bi bi-calendar-check me-2"></i> Đơn đặt tour
        </a>
        <hr style="border-color:#333;">
        <a class="nav-link" href="{{ route('home') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right me-2"></i> Xem website
        </a>
        <form action="{{ route('logout') }}" method="POST" class="px-2 mt-1">
            @csrf
            <button class="btn btn-sm btn-outline-danger w-100"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </form>
    </nav>
</div>

<div class="main-content">
    <div class="topbar d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h6>
        <span class="text-muted small"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
