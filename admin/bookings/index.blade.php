@extends('layouts.admin')
@section('title', 'Quản lý Đơn Đặt Tour')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0"><i class="bi bi-calendar-check text-danger"></i> Danh sách Đơn Đặt Tour</h5>
    <form action="" method="GET" class="d-flex gap-2">
        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">-- Tất cả trạng thái --</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Chờ xác nhận</option>
            <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
            <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Đã hủy</option>
        </select>
    </form>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Tour</th><th>Khách hàng</th><th>Số người</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th>Thao tác</th></tr>
            </thead>
            <tbody>
                @forelse($bookings as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td class="fw-bold">{{ $b->tour_name }}</td>
                    <td>{{ $b->user?->name ?? 'Khách vãng lai' }}</td>
                    <td>{{ $b->num_people }}</td>
                    <td class="text-danger fw-bold">{{ number_format($b->total_price, 0, ',', '.') }} VNĐ</td>
                    <td><span class="badge bg-{{ $b->status_badge }}">{{ $b->status_name }}</span></td>
                    <td><small>{{ $b->created_at->format('d/m/Y H:i') }}</small></td>
                    <td>
                        <a href="{{ route('admin.bookings.show', $b) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a>
                        @if($b->status === 'pending')
                            <form action="{{ route('admin.bookings.confirm', $b) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-success" title="Xác nhận"><i class="bi bi-check-lg"></i></button>
                            </form>
                            <form action="{{ route('admin.bookings.cancel', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Hủy đơn này?')">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-warning" title="Hủy"><i class="bi bi-x-lg"></i></button>
                            </form>
                        @endif
                        <form action="{{ route('admin.bookings.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa đơn này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Chưa có đơn nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($bookings->hasPages())
    <div class="card-footer bg-white">{{ $bookings->links() }}</div>
    @endif
</div>
@endsection
