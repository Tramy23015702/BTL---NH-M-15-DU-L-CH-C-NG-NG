@extends('layouts.admin')
@section('title', 'Thêm Hộ Dân')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:650px;">
    <div class="card-header bg-white fw-bold"><i class="bi bi-plus-circle text-success"></i> Thêm Hộ Dân Mới</div>
    <div class="card-body">
        <form action="{{ route('admin.households.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Điểm du lịch <span class="text-danger">*</span></label>
                <select name="destination_id" class="form-select" required>
                    <option value="">-- Chọn điểm du lịch --</option>
                    @foreach($destinations as $d)
                        <option value="{{ $d->id }}" {{ old('destination_id')==$d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Tên chủ hộ <span class="text-danger">*</span></label>
                <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Địa chỉ <span class="text-danger">*</span></label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Lưu</button>
                <a href="{{ route('admin.households.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
