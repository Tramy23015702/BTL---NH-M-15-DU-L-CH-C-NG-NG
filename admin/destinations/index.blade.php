@extends('layouts.admin')
@section('title', 'Quản lý Điểm Du Lịch')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0"><i class="bi bi-geo-alt text-success"></i> Danh sách Điểm Du Lịch</h5>
    <a href="{{ route('admin.destinations.create') }}" class="btn btn-success btn-sm">
        <i class="bi bi-plus-circle"></i> Thêm mới
    </a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Ảnh</th><th>Tên</th><th>Địa điểm</th><th>Loại</th><th>Trạng thái</th><th>Thao tác</th></tr>
            </thead>
            <tbody>
                @forelse($destinations as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>
                        @if($d->image_url)
                            <img src="{{ $d->image_url }}" width="60" height="45" style="object-fit:cover;border-radius:4px;">
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $d->name }}</td>
                    <td>{{ $d->location }}</td>
                    <td><span class="badge bg-success">{{ $d->type_name }}</span></td>
                    <td>
                        @if($d->is_active)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.destinations.edit', $d) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.destinations.destroy', $d) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Xóa điểm du lịch này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Chưa có điểm du lịch nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($destinations->hasPages())
    <div class="card-footer bg-white">{{ $destinations->links() }}</div>
    @endif
</div>
@endsection
