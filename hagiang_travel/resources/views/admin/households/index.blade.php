@extends('layouts.admin')
@section('title', 'Quản lý Hộ Dân')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0"><i class="bi bi-house-heart text-primary"></i> Danh sách Hộ Dân</h5>
    <a href="{{ route('admin.households.create') }}" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Thêm mới</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Chủ hộ</th><th>Điểm du lịch</th><th>SĐT</th><th>Địa chỉ</th><th>Thao tác</th></tr>
            </thead>
            <tbody>
                @forelse($households as $h)
                <tr>
                    <td>{{ $h->id }}</td>
                    <td class="fw-bold">{{ $h->owner_name }}</td>
                    <td>{{ $h->destination->name ?? '—' }}</td>
                    <td>{{ $h->phone }}</td>
                    <td>{{ $h->address }}</td>
                    <td>
                        <a href="{{ route('admin.households.edit', $h) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.households.destroy', $h) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa hộ dân này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Chưa có hộ dân nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($households->hasPages())
    <div class="card-footer bg-white">{{ $households->links() }}</div>
    @endif
</div>
@endsection
