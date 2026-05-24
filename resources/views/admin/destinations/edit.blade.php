@extends('layouts.admin')
@section('title', 'Sửa Điểm Du Lịch')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:700px;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-pencil text-warning"></i> Sửa: {{ $destination->name }}
    </div>
    <div class="card-body">
        <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Tên điểm du lịch <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $destination->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Địa điểm <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $destination->location) }}" required>
                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Loại hình <span class="text-danger">*</span></label>
                <select name="type" class="form-select" required>
                    <option value="van_hoa"     {{ old('type', $destination->type)=='van_hoa'     ? 'selected' : '' }}>🎭 Văn hóa</option>
                    <option value="lang_nghe"   {{ old('type', $destination->type)=='lang_nghe'   ? 'selected' : '' }}>🧵 Làng nghề</option>
                    <option value="ban_lang"    {{ old('type', $destination->type)=='ban_lang'    ? 'selected' : '' }}>🏘️ Bản làng</option>
                    <option value="thien_nhien" {{ old('type', $destination->type)=='thien_nhien' ? 'selected' : '' }}>🌿 Thiên nhiên</option>
                    <option value="mao_hiem"    {{ old('type', $destination->type)=='mao_hiem'    ? 'selected' : '' }}>🏔️ Mạo hiểm</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description', $destination->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh mới</label>
                @if($destination->image_url)
                    <div class="mb-2">
                        <img src="{{ $destination->image_url }}" height="80" style="border-radius:4px;">
                        <small class="text-muted ms-2">Ảnh hiện tại</small>
                    </div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Link Google Maps</label>
                <input type="url" name="map_link" class="form-control" value="{{ old('map_link', $destination->map_link) }}">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" {{ old('is_active', $destination->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="isActive">Hiển thị trên website</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Cập nhật</button>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
