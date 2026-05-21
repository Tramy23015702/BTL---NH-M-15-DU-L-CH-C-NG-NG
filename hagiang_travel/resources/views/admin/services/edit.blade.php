@extends('layouts.admin')
@section('title', 'Sửa Dịch Vụ')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:650px;">
    <div class="card-header bg-white fw-bold"><i class="bi bi-pencil text-warning"></i> Sửa: {{ $service->name }}</div>
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Điểm du lịch <span class="text-danger">*</span></label>
                <select name="destination_id" class="form-select" required>
                    @foreach($destinations as $d)
                        <option value="{{ $d->id }}" {{ old('destination_id', $service->destination_id)==$d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Tên dịch vụ <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Loại dịch vụ <span class="text-danger">*</span></label>
                <select name="type" class="form-select" required>
                    <option value="luu_tru" {{ old('type', $service->type)=='luu_tru' ? 'selected' : '' }}>Lưu trú / Homestay</option>
                    <option value="an_uong" {{ old('type', $service->type)=='an_uong' ? 'selected' : '' }}>Ăn uống</option>
                    <option value="trai_nghiem" {{ old('type', $service->type)=='trai_nghiem' ? 'selected' : '' }}>Trải nghiệm</option>
                    <option value="lang_nghe" {{ old('type', $service->type)=='lang_nghe' ? 'selected' : '' }}>Làng nghề</option>
                    <option value="khac" {{ old('type', $service->type)=='khac' ? 'selected' : '' }}>Khác</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="3" required>{{ old('description', $service->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Giá (VNĐ) <span class="text-danger">*</span></label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $service->price) }}" min="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh mới</label>
                @if($service->image_url)
                    <div class="mb-2"><img src="{{ $service->image_url }}" height="70" style="border-radius:4px;"></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Cập nhật</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
