@extends('layouts.app')
@section('title', 'Chi tiết Tour - Du lịch Cộng đồng Hà Giang')
@section('styles')
<style>
    .tour-hero {
        background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
            url('https://vantaivietmy.com/wp-content/uploads/2025/11/ha-giang.jpg') no-repeat center/cover;
        color: white; padding: 130px 0 70px;
    }
    .filter-tab { border-radius: 50px; padding: 8px 20px; font-weight: 600; transition: all 0.2s; }
    .filter-tab.active, .filter-tab:hover { transform: translateY(-2px); }
    .tour-card { border-radius: 12px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; }
    .tour-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.12); }
    .tour-img { height: 200px; object-fit: cover; width: 100%; }
    .price-tag { background: #fff3cd; border-left: 4px solid #ffc107; padding: 8px 12px; border-radius: 0 8px 8px 0; }
    .schedule-row { display: flex; gap: 10px; padding: 6px 0; border-bottom: 1px dashed #e9ecef; }
    .schedule-row:last-child { border-bottom: none; }
    .type-section { scroll-margin-top: 80px; }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="tour-hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Chi Tiết Các Gói Tour</h1>
        <p class="lead mb-4">Tìm hiểu đầy đủ lịch trình, dịch vụ và mức giá từng tour cộng đồng Hà Giang</p>
    </div>
</section>

{{-- Filter tabs 5 loại hình --}}
<div class="bg-white shadow-sm sticky-top" style="top:56px; z-index:100;">
    <div class="container py-2">
        <div class="d-flex gap-2 flex-wrap justify-content-center">
            <a href="{{ route('tour') }}"
               class="btn filter-tab {{ $activeType=='' ? 'btn-dark' : 'btn-outline-secondary' }}">
                🗺️ Tất cả
            </a>
            @foreach($types as $key => $label)
            @php
                $colors = ['van_hoa'=>'primary','lang_nghe'=>'warning','ban_lang'=>'success','thien_nhien'=>'info','mao_hiem'=>'danger'];
                $icons  = ['van_hoa'=>'🎭','lang_nghe'=>'🧵','ban_lang'=>'🏘️','thien_nhien'=>'🌿','mao_hiem'=>'🏔️'];
                $c = $colors[$key] ?? 'secondary';
            @endphp
            <a href="{{ route('tour') }}?type={{ $key }}"
               class="btn filter-tab {{ $activeType==$key ? 'btn-'.$c : 'btn-outline-'.$c }}">
                {{ $icons[$key] ?? '' }} {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- Nội dung tour --}}
<div class="container py-5">

    @if($destinations->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted"></i>
            <p class="text-muted mt-3 fs-5">Chưa có tour nào trong loại hình này.</p>
            <a href="{{ route('tour') }}" class="btn btn-success">Xem tất cả tour</a>
        </div>
    @else

        @foreach($types as $typeKey => $typeLabel)
            @if(isset($destinations[$typeKey]) && $destinations[$typeKey]->count() > 0)
            @php
                $colors = ['van_hoa'=>'primary','lang_nghe'=>'warning','ban_lang'=>'success','thien_nhien'=>'info','mao_hiem'=>'danger'];
                $icons  = ['van_hoa'=>'🎭','lang_nghe'=>'🧵','ban_lang'=>'🏘️','thien_nhien'=>'🌿','mao_hiem'=>'🏔️'];
                $bgImgs = [
                    // Chợ phiên / lễ hội dân tộc vùng cao Hà Giang
                    'van_hoa'     => 'https://halotravel.vn/wp-content/uploads/2022/08/Cho-phien-Ha-Giang.png',
                    // Dệt thổ cẩm / làng nghề thủ công
                    'lang_nghe'   => 'https://luhanhvietnam.com.vn/du-lich/vnt_upload/news/02_2023/lang-det-tho-cam-tay-bac-1.jpg',
                    // Bản làng nhà sàn vùng núi Đông Bắc
                    'ban_lang'    => 'https://bazaarvietnam.vn/wp-content/uploads/2025/01/du-lich-lang-lo-lo-chai-o-ha-giang-01.jpg',
                    // Ruộng bậc thang Hà Giang mùa vàng
                    'thien_nhien' => 'https://focusasiatravel.vn/wp-content/uploads/2018/08/Ru%E1%BB%99ng-b%E1%BA%ADc-thang-Ho%C3%A0ng-Su-Ph%C3%AC-2.jpg',
                    // Đèo núi hiểm trở Đông Bắc Việt Nam
                    'mao_hiem'    => 'https://2trip.vn/wp-content/uploads/2023/01/deo-ma-pi-leng-ha-giang-7-750x563.jpg',
                ];
                $c = $colors[$typeKey] ?? 'secondary';
                $icon = $icons[$typeKey] ?? '📍';
                $defaultImg = $bgImgs[$typeKey] ?? 'https://dulichkhatvongviet.com/wp-content/uploads/2020/08/ha_giang.jpg';
            @endphp

            <section class="type-section mb-5" id="{{ $typeKey }}">
                {{-- Section header --}}
                <div class="d-flex align-items-center gap-3 mb-4 pb-2 border-bottom border-{{ $c }}">
                    <span class="display-5">{{ $icon }}</span>
                    <div>
                        <h2 class="fw-bold text-{{ $c }} mb-0">Du Lịch {{ $typeLabel }}</h2>
                        <span class="text-muted">{{ $destinations[$typeKey]->count() }} tour</span>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach($destinations[$typeKey] as $dest)
                    @php $minPrice = $dest->services->min('price') ?? 500000; @endphp
                    <div class="col-md-4">
                        <div class="card tour-card h-100 shadow-sm border-0">
                            {{-- Ảnh --}}
                            @if($dest->image_url)
                                <img src="{{ $dest->image_url }}" class="tour-img" alt="{{ $dest->name }}">
                            @else
                                <img src="{{ $defaultImg }}" class="tour-img" alt="{{ $dest->name }}">
                            @endif

                            <div class="card-body d-flex flex-column">
                                {{-- Badge + tên --}}
                                <span class="badge bg-{{ $c }} mb-2 align-self-start">{{ $icon }} {{ $typeLabel }}</span>
                                <h5 class="fw-bold card-title">{{ $dest->name }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-geo-alt-fill text-danger"></i> {{ $dest->location }}
                                </p>

                                {{-- Giá --}}
                                <div class="price-tag mb-3">
                                    <span class="text-muted small">Giá từ</span>
                                    <span class="text-danger fw-bold fs-5 ms-1">
                                        {{ number_format($minPrice, 0, ',', '.') }} VNĐ
                                    </span>
                                    <span class="text-muted small">/người</span>
                                </div>

                                {{-- Mô tả --}}
                                <p class="text-muted small">{{ Str::limit($dest->description, 110) }}</p>

                                {{-- Lịch trình --}}
                                <div class="mb-3">
                                    <p class="fw-bold small mb-2"><i class="bi bi-calendar3 text-{{ $c }}"></i> Lịch trình:</p>
                                    <div class="schedule-row">
                                        <span class="badge bg-warning text-dark flex-shrink-0">Sáng</span>
                                        <span class="small text-muted">Đón khách, di chuyển đến {{ Str::limit($dest->name, 30) }}</span>
                                    </div>
                                    <div class="schedule-row">
                                        <span class="badge bg-success flex-shrink-0">Trưa</span>
                                        <span class="small text-muted">Ăn trưa, thưởng thức đặc sản địa phương</span>
                                    </div>
                                    <div class="schedule-row">
                                        <span class="badge bg-primary flex-shrink-0">Chiều</span>
                                        <span class="small text-muted">Tham quan, trải nghiệm hoạt động đặc trưng</span>
                                    </div>
                                    <div class="schedule-row">
                                        <span class="badge bg-dark flex-shrink-0">Tối</span>
                                        <span class="small text-muted">Giao lưu văn nghệ, nghỉ đêm tại Homestay</span>
                                    </div>
                                </div>

                                {{-- Dịch vụ --}}
                                @if($dest->services->count() > 0)
                                <div class="mb-3">
                                    <p class="fw-bold small mb-1"><i class="bi bi-check-circle text-{{ $c }}"></i> Bao gồm:</p>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($dest->services->take(3) as $svc)
                                        <span class="badge bg-light text-dark border small">
                                            {{ $svc->name }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                {{-- Nút --}}
                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('destinations.show', $dest) }}"
                                       class="btn btn-outline-{{ $c }} btn-sm flex-fill">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                    @auth
                                        <button class="btn btn-{{ $c }} btn-sm flex-fill fw-bold"
                                            onclick="openTourModal('{{ addslashes($dest->name) }}', {{ $minPrice }}, '{{ addslashes($dest->description) }}')">
                                            <i class="bi bi-calendar-check"></i> Đặt tour
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-{{ $c }} btn-sm flex-fill fw-bold">
                                            <i class="bi bi-calendar-check"></i> Đặt tour
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        @endforeach

    @endif
</div>

{{-- CTA --}}
<section class="bg-dark text-white text-center py-5">
    <div class="container">
        <h3 class="fw-bold mb-3">Sẵn sàng khám phá Hà Giang?</h3>
        <p class="lead mb-4">Đặt tour ngay hôm nay để nhận ưu đãi tốt nhất từ hệ thống du lịch cộng đồng</p>
        <a href="{{ route('home') }}" class="btn btn-success btn-lg px-5 me-2">
            <i class="bi bi-house"></i> Về trang chủ
        </a>
        @guest
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5">
                <i class="bi bi-person-plus"></i> Đăng ký ngay
            </a>
        @endguest
    </div>
</section>

{{-- Modal đặt tour --}}
@auth
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
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Số lượng người:</label>
                            <input type="number" name="num_people" id="numPeople" class="form-control" value="1" min="1" onchange="generateMemberInputs()">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ tên từng thành viên:</label>
                        <div id="memberNamesContainer">
                            <input type="text" name="member_names[]" class="form-control mb-2" placeholder="Thành viên 1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-success">Dịch vụ đính kèm (tùy chọn):</label>
                        <div class="form-check p-3 border rounded mb-2 bg-light">
                            <input class="form-check-input service-cb ms-1 me-2" type="checkbox" name="services[]" value="Thuê xe máy bản địa" data-price="200000" onchange="calculateTotal()">
                            <label class="form-check-label fw-bold">Thuê xe máy di chuyển (+200.000 VNĐ/ngày)</label>
                        </div>
                        <div class="form-check p-3 border rounded bg-light">
                            <input class="form-check-input service-cb ms-1 me-2" type="checkbox" name="services[]" value="Giao lưu văn nghệ đốt lửa trại" data-price="600000" onchange="calculateTotal()">
                            <label class="form-check-label fw-bold">Đêm giao lưu văn nghệ & Đốt lửa trại (+600.000 VNĐ/gói)</label>
                        </div>
                    </div>
                    <div class="alert alert-warning d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">💰 Tổng chi phí:</h5>
                        <h4 class="mb-0 text-danger fw-bold"><span id="totalPriceLabel">0</span> VNĐ</h4>
                        <input type="hidden" name="total_price" id="inputTotalPrice">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success px-4 fw-bold">
                        <i class="bi bi-check-circle"></i> Xác nhận Đặt Tour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

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
        document.querySelectorAll('.service-cb').forEach(cb => cb.checked = false);
        calculateTotal();
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
            input.placeholder = `Họ và tên thành viên thứ ${i}`;
            input.required = true;
            container.appendChild(input);
        }
        calculateTotal();
    }
    function calculateTotal() {
        const count = parseInt(document.getElementById('numPeople').value) || 1;
        let total = basePrice * count;
        document.querySelectorAll('.service-cb:checked').forEach(cb => {
            total += parseFloat(cb.getAttribute('data-price'));
        });
        document.getElementById('totalPriceLabel').innerText = total.toLocaleString('vi-VN');
        document.getElementById('inputTotalPrice').value = total;
    }
</script>
@endsection
