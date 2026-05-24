@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $stats['destinations'] }}</div>
                    <div>Điểm du lịch</div>
                </div>
                <i class="bi bi-geo-alt display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $stats['households'] }}</div>
                    <div>Hộ dân</div>
                </div>
                <i class="bi bi-house-heart display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-white bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $stats['services'] }}</div>
                    <div>Dịch vụ</div>
                </div>
                <i class="bi bi-grid display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm text-white bg-danger">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $stats['bookings'] }}</div>
                    <div>Đơn đặt tour</div>
                </div>
                <i class="bi bi-calendar-check display-4 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="text-warning fw-bold fs-4">{{ $stats['pending'] }}</div>
                <div class="text-muted">Chờ xác nhận</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="text-success fw-bold fs-4">{{ $stats['confirmed'] }}</div>
                <div class="text-muted">Đã xác nhận</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="text-danger fw-bold fs-4">{{ $stats['cancelled'] }}</div>
                <div class="text-muted">Đã hủy</div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-clock-history text-success"></i> Đơn đặt tour gần đây
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th><th>Tên tour</th><th>Khách hàng</th><th>Số người</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td class="fw-bold">{{ $b->tour_name }}</td>
                    <td>{{ $b->user?->name ?? 'Khách' }}</td>
                    <td>{{ $b->num_people }}</td>
                    <td class="text-danger">{{ number_format($b->total_price, 0, ',', '.') }} VNĐ</td>
                    <td><span class="badge bg-{{ $b->status_badge }}">{{ $b->status_name }}</span></td>
                    <td><small>{{ $b->created_at->format('d/m/Y') }}</small></td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-3">Chưa có đơn nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-success">Xem tất cả đơn</a>
    </div>
</div>
@endsection
