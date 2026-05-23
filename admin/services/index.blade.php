@extends('layouts.admin')
@section('title', 'Quản lý Dịch Vụ')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0"><i class="bi bi-grid text-warning"></i> Danh sách Dịch Vụ</h5>
    <a href="{{ route('admin.services.create') }}" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Thêm mới</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Tên dịch vụ</th><th>Điểm du lịch</th><th>Loại</th><th>Giá</th><th>Thao tác</th></tr>
            </thead>
            <tbody>
                @forelse($services as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td class="fw-bold">{{ $s->name }}</td>
                    <td>{{ $s->destination->name ?? '—' }}</td>
                    <td><span class="badge bg-warning text-dark">{{ $s->type_name }}</span></td>
                    <td class="text-danger fw-bold">{{ number_format($s->price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $s) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.services.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa dịch vụ này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Chưa có dịch vụ nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($services->hasPages())
    <div class="card-footer bg-white">{{ $services->links() }}</div>
    @endif
</div>
@endsection
