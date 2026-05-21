@extends('layouts.admin')
@section('title', 'Sửa Hộ Dân')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:650px;">
    <div class="card-header bg-white fw-bold"><i class="bi bi-pencil text-warning"></i> Sửa: {{ $household->owner_name }}</div>
    <div class="card-body">
        <form action="{{ route('admin.households.update', $household) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Điểm du lịch <span class="text-danger">*</span></label>
                <select name="destination_id" class="form-select" required>
                    @foreach($destinations as $d)
                        <option value="{{ $d->id }}" {{ old('destination_id', $household->destination_id)==$d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Tên chủ hộ <span class="text-danger">*</span></label>
                <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name', $household->owner_name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $household->phone) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Địa chỉ <span class="text-danger">*</span></label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $household->address) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $household->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh mới</label>
                @if($household->image_url)
                    <div class="mb-2"><img src="{{ $household->image_url }}" height="70" style="border-radius:4px;"></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Cập nhật</button>
                <a href="{{ route('admin.households.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
