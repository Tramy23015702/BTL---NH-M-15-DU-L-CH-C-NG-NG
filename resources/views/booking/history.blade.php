@extends('layouts.app')
@section('title', 'Lịch sử đặt tour')
@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-clock-history text-success"></i> Lịch sử đặt tour của bạn</h3>

    @if($bookings->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên Tour</th>
                        <th>Số người</th>
                        <th>Thành viên</th>
                        <th>Dịch vụ</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td class="fw-bold">{{ $booking->tour_name }}</td>
                        <td>{{ $booking->num_people }} người</td>
                        <td><small>{{ $booking->member_names }}</small></td>
                        <td><small>{{ $booking->services ?: '—' }}</small></td>
                        <td class="text-danger fw-bold">{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</td>
                        <td>
                            <span class="badge bg-{{ $booking->status_badge }}">{{ $booking->status_name }}</span>
                        </td>
                        <td><small>{{ $booking->created_at->format('d/m/Y H:i') }}</small></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $bookings->links() }}
    @else
        <div class="text-center py-5">
            <i class="bi bi-calendar-x display-1 text-muted"></i>
            <p class="text-muted mt-3">Bạn chưa có đơn đặt tour nào.</p>
            <a href="{{ route('home') }}" class="btn btn-success">Khám phá tour ngay</a>
        </div>
    @endif
</div>
@endsection
