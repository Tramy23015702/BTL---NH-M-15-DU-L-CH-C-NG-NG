@extends('layouts.app')
@section('title', $destination->name)
@section('content')

<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">{{ $destination->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-md-7">
            @if($destination->image_url)
                <img src="{{ $destination->image_url }}" class="img-fluid rounded shadow" alt="{{ $destination->name }}" style="width:100%;max-height:400px;object-fit:cover;">
            @else
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800" class="img-fluid rounded shadow" alt="{{ $destination->name }}" style="width:100%;max-height:400px;object-fit:cover;">
            @endif
        </div>
        <div class="col-md-5">
            <span class="badge bg-success mb-2 fs-6">{{ $destination->type_name }}</span>
            <h2 class="fw-bold">{{ $destination->name }}</h2>
            <p class="text-muted"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $destination->location }}</p>
            <p>{{ $destination->description }}</p>
            @if($destination->map_link)
                <a href="{{ $destination->map_link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-map"></i> Xem trên Google Maps
                </a>
            @endif
            <div class="mt-3">
                @auth
                    <button class="btn btn-success fw-bold"
                        onclick="openTourModal('{{ $destination->name }}', 1500000, '{{ addslashes($destination->description) }}')">
                        <i class="bi bi-calendar-check"></i> Đặt tour ngay
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success fw-bold">
                        <i class="bi bi-calendar-check"></i> Đăng nhập để đặt tour
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- Hộ dân --}}
    @if($destination->households->count() > 0)
    <div class="mt-5">
        <h4 class="fw-bold text-success"><i class="bi bi-house-heart"></i> Hộ dân / Đơn vị tham gia</h4>
        <div class="row g-3 mt-2">
            @foreach($destination->households as $hh)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    @if($hh->image_url)
                        <img src="{{ $hh->image_url }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $hh->owner_name }}">
                    @endif
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $hh->owner_name }}</h6>
                        <p class="text-muted small mb-1"><i class="bi bi-telephone"></i> {{ $hh->phone }}</p>
                        <p class="text-muted small"><i class="bi bi-pin-map"></i> {{ $hh->address }}</p>
                        @if($hh->description)<p class="small">{{ $hh->description }}</p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Dịch vụ --}}
    @if($destination->services->count() > 0)
    <div class="mt-5">
        <h4 class="fw-bold text-danger"><i class="bi bi-grid"></i> Dịch vụ cộng đồng</h4>
        <div class="row g-3 mt-2">
            @foreach($destination->services as $service)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    @if($service->image_url)
                        <img src="{{ $service->image_url }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $service->name }}">
                    @endif
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-1">{{ $service->type_name }}</span>
                        <h6 class="fw-bold">{{ $service->name }}</h6>
                        <p class="text-muted small">{{ $service->description }}</p>
                        <p class="text-danger fw-bold">{{ number_format($service->price, 0, ',', '.') }} VNĐ</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

{{-- Modal đặt tour --}}
<div class="modal fade" id="tourModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="modalTourName"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="modalTourDesc" class="bg-light p-3 rounded text-secondary"></p>
                    <hr>
                    <input type="hidden" name="tour_name" id="inputTourName">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số lượng người:</label>
                        <input type="number" name="num_people" id="numPeople" class="form-control" value="1" min="1" onchange="generateMemberInputs()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ tên thành viên:</label>
                        <div id="memberNamesContainer">
                            <input type="text" name="member_names[]" class="form-control mb-2" placeholder="Thành viên 1" required>
                        </div>
                    </div>
                    <div class="alert alert-warning d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">Tổng chi phí:</h6>
                        <h5 class="mb-0 text-danger fw-bold"><span id="totalPriceLabel">0</span> VNĐ</h5>
                        <input type="hidden" name="total_price" id="inputTotalPrice">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success fw-bold">Xác nhận Đặt Tour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let basePrice = 0;
    function openTourModal(name, price, description) {
        basePrice = price;
        document.getElementById('modalTourName').innerText = name;
        document.getElementById('inputTourName').value = name;
        document.getElementById('modalTourDesc').innerText = description;
        document.getElementById('numPeople').value = 1;
        generateMemberInputs();
        document.getElementById('inputTotalPrice').value = price;
        document.getElementById('totalPriceLabel').innerText = price.toLocaleString('vi-VN');
        new bootstrap.Modal(document.getElementById('tourModal')).show();
    }
    function generateMemberInputs() {
        const container = document.getElementById('memberNamesContainer');
        const count = parseInt(document.getElementById('numPeople').value) || 1;
        container.innerHTML = '';
        for (let i = 1; i <= count; i++) {
            const input = document.createElement('input');
            input.type = 'text'; input.name = 'member_names[]';
            input.className = 'form-control mb-2';
            input.placeholder = `Thành viên ${i}`; input.required = true;
            container.appendChild(input);
        }
        document.getElementById('inputTotalPrice').value = basePrice * count;
        document.getElementById('totalPriceLabel').innerText = (basePrice * count).toLocaleString('vi-VN');
    }
</script>
@endsection
