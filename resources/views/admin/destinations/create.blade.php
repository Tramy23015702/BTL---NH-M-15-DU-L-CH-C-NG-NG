@extends('layouts.admin')
@section('title', 'Thêm Điểm Du Lịch')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:700px;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-plus-circle text-success"></i> Thêm Điểm Du Lịch Mới
    </div>
    <div class="card-body">
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Tên điểm du lịch <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Địa điểm <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="VD: Quản Bạ, Hà Giang" required>
                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Loại hình <span class="text-danger">*</span></label>
                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">-- Chọn loại --</option>
                    <option value="van_hoa"     {{ old('type')=='van_hoa'     ? 'selected' : '' }}>🎭 Văn hóa</option>
                    <option value="lang_nghe"   {{ old('type')=='lang_nghe'   ? 'selected' : '' }}>🧵 Làng nghề</option>
                    <option value="ban_lang"    {{ old('type')=='ban_lang'    ? 'selected' : '' }}>🏘️ Bản làng</option>
                    <option value="thien_nhien" {{ old('type')=='thien_nhien' ? 'selected' : '' }}>🌿 Thiên nhiên</option>
                    <option value="mao_hiem"    {{ old('type')=='mao_hiem'    ? 'selected' : '' }}>🏔️ Mạo hiểm</option>
                </select>
                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Link Google Maps</label>
                <input type="url" name="map_link" class="form-control @error('map_link') is-invalid @enderror" value="{{ old('map_link') }}" placeholder="https://maps.google.com/...">
                @error('map_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" {{ old('is_active', '1') ? 'checked' : '' }}>
                <label class="form-check-label" for="isActive">Hiển thị trên website</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Lưu</button>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
