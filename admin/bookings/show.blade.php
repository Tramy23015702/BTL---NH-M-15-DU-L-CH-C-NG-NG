@extends('layouts.admin')
@section('title', 'Chi tiết Đơn #' . $booking->id)
@section('content')
<div class="card border-0 shadow-sm" style="max-width:650px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold"><i class="bi bi-file-text text-info"></i> Đơn đặt tour #{{ $booking->id }}</span>
        <span class="badge bg-{{ $booking->status_badge }} fs-6">{{ $booking->status_name }}</span>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr><th width="160">Tên tour:</th><td class="fw-bold">{{ $booking->tour_name }}</td></tr>
            <tr><th>Khách hàng:</th><td>{{ $booking->user?->name ?? 'Khách vãng lai' }}</td></tr>
            <tr><th>Email:</th><td>{{ $booking->user?->email ?? '—' }}</td></tr>
            <tr><th>Số người:</th><td>{{ $booking->num_people }} người</td></tr>
            <tr><th>Thành viên:</th><td>{{ $booking->member_names }}</td></tr>
            <tr><th>Dịch vụ thêm:</th><td>{{ $booking->services ?: '—' }}</td></tr>
            <tr><th>Tổng tiền:</th><td class="text-danger fw-bold">{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</td></tr>
            <tr><th>Ngày đặt:</th><td>{{ $booking->created_at->format('d/m/Y H:i') }}</td></tr>
        </table>

        <div class="d-flex gap-2 mt-3">
            @if($booking->status === 'pending')
                <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST">
                    @csrf @method('PATCH')
                    <button class="btn btn-success"><i class="bi bi-check-circle"></i> Xác nhận đơn</button>
                </form>
                <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Hủy đơn này?')">
                    @csrf @method('PATCH')
                    <button class="btn btn-warning"><i class="bi bi-x-circle"></i> Hủy đơn</button>
                </form>
            @endif
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">← Quay lại</a>
        </div>
    </div>
</div>
@endsection
