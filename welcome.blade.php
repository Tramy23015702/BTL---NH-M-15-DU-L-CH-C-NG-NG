@extends('layouts.app')
@section('title', 'Du lịch Cộng đồng Hà Giang')
@section('styles')
<style>
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
            url('https://scontent.fhan2-4.fna.fbcdn.net/v/t39.30808-6/487337893_625278093649488_114404241120156528_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeHgaT9RQqOwEvk0KQoxLTlnL0pCMtg2_ZcvSkIy2Db9l0sNl1gaf1MexOiL6EzD3FZPi-A2qECetLcAOG1ep25Y&_nc_ohc=ex-FLvDpn2sQ7kNvwEFCnTX&_nc_oc=AdpDYoEDsYs-Y3fLIwSdRn64zd6wcGJ7wf1MT_PLisFUI4ZWrX7hHpudAfuHx5eYOgWn7un4ZebAnOfIZbYC4rTl&_nc_zt=23&_nc_ht=scontent.fhan2-4.fna&_nc_gid=tGn5oGvpY1XCa0-u3iqtFQ&_nc_ss=7b2a8&oh=00_Af7D3VS-WMI1JgqdRORg4SvBhtfJ7s4_C-0HdodKJwcCMw&oe=6A135BFE') no-repeat center/cover;
        color: white; min-height: 92vh;
        display: flex; align-items: center; justify-content: center;
    }
    section { padding: 70px 0; }
    .type-card {
        border: none; border-radius: 16px; overflow: hidden;
        transition: transform 0.25s, box-shadow 0.25s;
        cursor: pointer; text-decoration: none; color: inherit;
    }
    .type-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,0.15); }
    .type-card .cover {
        height: 200px; object-fit: cover; width: 100%;
        transition: transform 0.4s;
    }
    .type-card:hover .cover { transform: scale(1.05); }
    .type-card .overlay {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.75));
        padding: 30px 16px 16px;
        color: white;
    }
    .type-card-wrap { position: relative; overflow: hidden; border-radius: 16px 16px 0 0; }
    .search-box { background: white; border-radius: 16px; padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Khám Phá Du Lịch Cộng Đồng Hà Giang</h1>
        <p class="lead mb-4">Trải nghiệm nét đẹp văn hóa bản địa, ruộng bậc thang vạt nắng và những cung đường đèo hùng vĩ Đông Bắc.</p>
        <a href="#loai-hinh" class="btn btn-success btn-lg px-5 me-2">
            <i class="bi bi-compass"></i> Khám phá ngay
        </a>
        @guest
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5">
                <i class="bi bi-person-plus"></i> Đăng ký tham gia
            </a>
        @endguest
    </div>
</section>

{{-- Tìm kiếm nhanh --}}
<section class="bg-light py-4" id="loai-hinh">
    <div class="container">
        <div class="search-box">
            <div class="text-center mb-4">
                <h4 class="fw-bold mb-1"><i class="bi bi-search text-success"></i> Tìm kiếm nhanh theo loại hình</h4>
                <p class="text-muted small mb-0">Chọn loại hình du lịch bạn quan tâm để xem chi tiết các tour</p>
            </div>
            <div class="row g-3 justify-content-center">
                @foreach([
                    ['type'=>'van_hoa',     'icon'=>'🎭', 'label'=>'Văn hóa',    'color'=>'primary',  'desc'=>'Lễ hội, phong tục, di sản'],
                    ['type'=>'lang_nghe',   'icon'=>'🧵', 'label'=>'Làng nghề',  'color'=>'warning',  'desc'=>'Dệt, rèn, đan lát thủ công'],
                    ['type'=>'ban_lang',    'icon'=>'🏘️', 'label'=>'Bản làng',   'color'=>'success',  'desc'=>'Homestay, cộng đồng dân tộc'],
                    ['type'=>'thien_nhien', 'icon'=>'🌿', 'label'=>'Thiên nhiên','color'=>'info',     'desc'=>'Ruộng bậc thang, hồ, rừng'],
                    ['type'=>'mao_hiem',    'icon'=>'🏔️', 'label'=>'Mạo hiểm',  'color'=>'danger',   'desc'=>'Trekking, leo núi, dù lượn'],
                ] as $item)
                <div class="col-6 col-md-2">
                    <a href="{{ route('tour') }}?type={{ $item['type'] }}"
                       class="d-block text-center p-3 rounded-3 border border-{{ $item['color'] }} text-decoration-none h-100
                              {{ request('type')==$item['type'] ? 'bg-'.$item['color'].' text-white' : 'bg-white text-dark' }}"
                       style="transition: all 0.2s;">
                        <div class="fs-2 mb-1">{{ $item['icon'] }}</div>
                        <div class="fw-bold small">{{ $item['label'] }}</div>
                        <div class="text-muted" style="font-size:0.72rem;">{{ $item['desc'] }}</div>
                    </a>
                </div>
                @endforeach
                <div class="col-6 col-md-2">
                    <a href="{{ route('tour') }}"
                       class="d-block text-center p-3 rounded-3 border border-secondary text-decoration-none h-100 bg-white text-dark"
                       style="transition: all 0.2s;">
                        <div class="fs-2 mb-1">🗺️</div>
                        <div class="fw-bold small">Tất cả</div>
                        <div class="text-muted" style="font-size:0.72rem;">Xem toàn bộ tour</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 5 loại hình du lịch dạng card ảnh --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold"><i class="bi bi-geo-alt text-success"></i> 5 Loại Hình Du Lịch Cộng Đồng</h2>
            <p class="text-muted">Bấm vào từng loại hình để xem đầy đủ các tour chi tiết</p>
        </div>
        <div class="row g-4">

            @foreach([
                ['type'=>'van_hoa',     'icon'=>'🎭', 'label'=>'Du Lịch Văn Hóa',    'color'=>'primary',
                 'img'=>'https://xebangphan.vn/wp-content/uploads/2024/12/thumb-lang-van-hoa-o-ha-giang.jpg',
                 'desc'=>'Khám phá lễ hội, phong tục tập quán và di sản văn hóa đặc sắc của các dân tộc thiểu số Hà Giang.'],
                ['type'=>'lang_nghe',   'icon'=>'🧵', 'label'=>'Du Lịch Làng Nghề',  'color'=>'warning',
                 'img'=>'https://onevivu.vn/wp-content/uploads/2021/08/Lang-tho-cam-Lung-Tam.jpg',
                 'desc'=>'Trải nghiệm và học hỏi các nghề thủ công truyền thống: dệt thổ cẩm, rèn dao, làm giấy bản.'],
                ['type'=>'ban_lang',    'icon'=>'🏘️', 'label'=>'Du Lịch Bản Làng',   'color'=>'success',
                 'img'=>'https://bazaarvietnam.vn/wp-content/uploads/2025/01/du-lich-lang-lo-lo-chai-o-ha-giang-01.jpg',
                 'desc'=>'Sống cùng đồng bào dân tộc trong các bản làng yên bình, trải nghiệm cuộc sống bản địa thực sự.'],
                ['type'=>'thien_nhien', 'icon'=>'🌿', 'label'=>'Du Lịch Thiên Nhiên','color'=>'info',
                 'img'=>'https://bvhttdl.mediacdn.vn/291773308735864832/2021/9/4/hoang-su-phi-16307477747701342685256-1630749867351-16307498675151279912971.jpg',
                 'desc'=>'Chiêm ngưỡng ruộng bậc thang, hồ núi, rừng nguyên sinh và những cảnh quan thiên nhiên hùng vĩ.'],
                ['type'=>'mao_hiem',    'icon'=>'🏔️', 'label'=>'Du Lịch Mạo Hiểm',  'color'=>'danger',
                 'img'=>'https://media.mia.vn/uploads/blog-du-lich/An-tuong-lang-van-hoa-du-lich-lung-cam-ha-giang-gam-hoa-mien-cuc-bac-07-1644000463.jpg',
                 'desc'=>'Chinh phục giới hạn bản thân với trekking, leo núi, dù lượn, kayak trên những địa hình hiểm trở.'],
            ] as $item)
            <div class="col-md-4 col-sm-6">
                <a href="{{ route('tour') }}?type={{ $item['type'] }}" class="type-card d-block shadow-sm">
                    <div class="type-card-wrap">
                        <img src="{{ $item['img'] }}" class="cover" alt="{{ $item['label'] }}">
                        <div class="overlay">
                            <div class="fs-4 mb-1">{{ $item['icon'] }}</div>
                            <h5 class="fw-bold mb-1">{{ $item['label'] }}</h5>
                            <span class="badge bg-{{ $item['color'] }} bg-opacity-90">6 tour</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white border-top">
                        <p class="text-muted small mb-2">{{ $item['desc'] }}</p>
                        <span class="text-{{ $item['color'] }} fw-bold small">
                            Xem chi tiết <i class="bi bi-arrow-right"></i>
                        </span>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- Trải nghiệm nổi bật --}}
<section class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-danger"><i class="bi bi-stars"></i> Trải Nghiệm Nổi Bật</h2>
            <p class="text-muted">Những hoạt động đặc sắc không thể bỏ lỡ khi đến Hà Giang</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach([
                ['icon'=>'bi-house-heart','color'=>'success','title'=>'Homestay Bản Địa','desc'=>'Ngủ đêm tại nhà trình tường, nhà sàn truyền thống của đồng bào dân tộc.'],
                ['icon'=>'bi-egg-fried','color'=>'warning','title'=>'Ẩm Thực Địa Phương','desc'=>'Thưởng thức thắng cố, lạp xưởng gác bếp, cá bống suối nướng đặc sản.'],
                ['icon'=>'bi-bicycle','color'=>'danger','title'=>'Trekking & Mạo Hiểm','desc'=>'Chinh phục Mã Pí Lèng, vách đá trắng và những cung đường đèo huyền thoại.'],
                ['icon'=>'bi-music-note-beamed','color'=>'primary','title'=>'Văn Nghệ Bản Làng','desc'=>'Giao lưu hát Then, múa khèn Mông, đốt lửa trại dưới bầu trời đầy sao.'],
            ] as $item)
            <div class="col-md-3 col-sm-6 text-center">
                <div class="p-4 bg-white border rounded-3 shadow-sm h-100">
                    <i class="bi {{ $item['icon'] }} display-4 text-{{ $item['color'] }}"></i>
                    <h5 class="fw-bold mt-3">{{ $item['title'] }}</h5>
                    <p class="text-muted small">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Liên hệ --}}
<section class="bg-dark text-white text-center py-5">
    <div class="container">
        <h2 class="fw-bold mb-3">Liên Hệ Hệ Thống Du Lịch Cộng Đồng Hà Giang</h2>
        <p class="lead mb-2">Văn phòng hỗ trợ thông tin và điều phối dịch vụ bản địa</p>
        <p>Hotline 24/7: <strong class="text-warning">0123.456.789</strong> | Email: contact@hagiangtravel.gov.vn</p>
    </div>
</section>

@endsection
