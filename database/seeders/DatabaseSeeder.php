<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Household;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== TÀI KHOẢN =====
        User::firstOrCreate(['email' => 'admin@hagiangtravel.vn'], [
            'name' => 'Quản trị viên', 'password' => Hash::make('admin123'), 'role' => 'admin',
        ]);
        User::firstOrCreate(['email' => 'user@hagiangtravel.vn'], [
            'name' => 'Nguyễn Văn A', 'password' => Hash::make('user123'), 'role' => 'user',
        ]);

        // ===== 30 TOUR (6 × 5 loại hình) — giá chênh lệch rõ ràng =====
        // Giá homestay (giá chính của tour), giá ăn uống (dịch vụ phụ)
        $tours = [

            // ── VĂN HÓA: 650k → 2.200k ──────────────────────────────────
            ['name'=>'Chợ Phiên Bắc Hà Cuối Tuần',         'location'=>'Bắc Hà, Hà Giang',      'type'=>'van_hoa',     'price'=>650000,
             'desc'=>'Tham quan phiên chợ vùng cao họp mỗi chủ nhật, nơi hội tụ hơn 10 dân tộc thiểu số với trang phục truyền thống, hàng thủ công và ẩm thực đặc sắc.'],
            ['name'=>'Đêm Văn Nghệ Dân Tộc Yên Minh',      'location'=>'Yên Minh, Hà Giang',     'type'=>'van_hoa',     'price'=>850000,
             'desc'=>'Thưởng thức đêm giao lưu văn nghệ với các tiết mục hát Then, múa sạp, thổi khèn của đồng bào các dân tộc Tày, Nùng, H\'Mông tại huyện Yên Minh.'],
            ['name'=>'Lễ Hội Khèn Mông Mèo Vạc',           'location'=>'Mèo Vạc, Hà Giang',     'type'=>'van_hoa',     'price'=>1050000,
             'desc'=>'Hòa mình vào lễ hội khèn Mông truyền thống, thưởng thức điệu múa khèn đặc sắc, trang phục thổ cẩm rực rỡ và các trò chơi dân gian của người H\'Mông.'],
            ['name'=>'Khám Phá Phố Cổ Đồng Văn',           'location'=>'Đồng Văn, Hà Giang',    'type'=>'van_hoa',     'price'=>1300000,
             'desc'=>'Dạo bước qua những con phố cổ hàng trăm năm tuổi, tham quan dinh thự họ Vương, chợ phiên Đồng Văn và tìm hiểu văn hóa đặc sắc của đồng bào H\'Mông, Lô Lô.'],
            ['name'=>'Tìm Hiểu Văn Hóa Người Lô Lô Đen',  'location'=>'Mèo Vạc, Hà Giang',     'type'=>'van_hoa',     'price'=>1650000,
             'desc'=>'Khám phá nét văn hóa độc đáo của người Lô Lô Đen — một trong những dân tộc ít người nhất Việt Nam, với trang phục thêu tay tinh xảo và nghi lễ truyền thống.'],
            ['name'=>'Di Sản Địa Chất Cao Nguyên Đá UNESCO','location'=>'Đồng Văn, Hà Giang',   'type'=>'van_hoa',     'price'=>2200000,
             'desc'=>'Tham quan Công viên Địa chất Toàn cầu UNESCO Cao nguyên đá Đồng Văn, tìm hiểu lịch sử địa chất hàng triệu năm và nền văn hóa đặc sắc của các dân tộc bản địa.'],

            // ── LÀNG NGHỀ: 450k → 1.400k ─────────────────────────────────
            ['name'=>'Đan Lát Mây Tre Bản Địa',            'location'=>'Bắc Quang, Hà Giang',   'type'=>'lang_nghe',   'price'=>450000,
             'desc'=>'Trải nghiệm nghề đan lát mây tre truyền thống của đồng bào dân tộc, tạo ra các vật dụng sinh hoạt hàng ngày như gùi, rổ, rá theo phương pháp thủ công cổ truyền.'],
            ['name'=>'Làm Giấy Bản Người Dao Đỏ',          'location'=>'Hoàng Su Phì, Hà Giang','type'=>'lang_nghe',   'price'=>600000,
             'desc'=>'Khám phá nghề làm giấy bản thủ công của người Dao Đỏ — loại giấy được dùng trong các nghi lễ tâm linh. Trực tiếp tham gia quy trình từ nguyên liệu đến thành phẩm.'],
            ['name'=>'Nghề Rèn Dao Truyền Thống Người Mông','location'=>'Đồng Văn, Hà Giang',   'type'=>'lang_nghe',   'price'=>750000,
             'desc'=>'Tìm hiểu nghề rèn dao thủ công truyền thống của người H\'Mông, xem nghệ nhân tạo ra những con dao sắc bén từ sắt thô qua bàn tay khéo léo và lò rèn thủ công.'],
            ['name'=>'Nấu Rượu Ngô Men Lá Đặc Sản',        'location'=>'Mèo Vạc, Hà Giang',     'type'=>'lang_nghe',   'price'=>900000,
             'desc'=>'Tìm hiểu quy trình nấu rượu ngô men lá truyền thống của người H\'Mông — loại rượu nổi tiếng khắp vùng Đông Bắc với hương vị đặc trưng không thể nhầm lẫn.'],
            ['name'=>'Thêu Trang Phục Dân Tộc Tày',        'location'=>'Vị Xuyên, Hà Giang',    'type'=>'lang_nghe',   'price'=>1100000,
             'desc'=>'Học nghề thêu trang phục truyền thống của người Tày với những hoa văn hình học đặc trưng. Nghệ nhân sẽ hướng dẫn từng bước từ chọn chỉ đến hoàn thiện sản phẩm.'],
            ['name'=>'Dệt Thổ Cẩm Làng Lùng Tám',         'location'=>'Quản Bạ, Hà Giang',     'type'=>'lang_nghe',   'price'=>1400000,
             'desc'=>'Tham quan và trực tiếp trải nghiệm nghề dệt thổ cẩm truyền thống của người H\'Mông tại làng Lùng Tám. Học cách tạo ra những hoa văn tinh xảo trên khung dệt thủ công.'],

            // ── BẢN LÀNG: 800k → 2.500k ──────────────────────────────────
            ['name'=>'Bản Người Nùng Bên Suối Minh Ngọc',  'location'=>'Vị Xuyên, Hà Giang',    'type'=>'ban_lang',    'price'=>800000,
             'desc'=>'Nghỉ ngơi tại bản làng người Nùng bên dòng suối trong xanh, tham gia các hoạt động nông nghiệp, câu cá suối và thưởng thức bữa tối với các món ăn dân dã.'],
            ['name'=>'Bản Cổ Người Giáy Phó Bảng',         'location'=>'Đồng Văn, Hà Giang',    'type'=>'ban_lang',    'price'=>1050000,
             'desc'=>'Tham quan bản làng người Giáy với kiến trúc nhà cổ độc đáo, tìm hiểu văn hóa ẩm thực đặc trưng và nghề trồng lanh dệt vải truyền thống của dân tộc Giáy.'],
            ['name'=>'Bản Làng Người Tày Thôn Tha',        'location'=>'Vị Xuyên, Hà Giang',    'type'=>'ban_lang',    'price'=>1250000,
             'desc'=>'Sống cùng người Tày trong những ngôi nhà sàn mái cọ rêu phong bên hồ nước tĩnh lặng. Nghe hát Then, thưởng thức cá bống suối nướng và vịt làng tiến vua đặc sản.'],
            ['name'=>'Làng Cổ Người Dao Đỏ Tả Phìn',      'location'=>'Hoàng Su Phì, Hà Giang','type'=>'ban_lang',    'price'=>1550000,
             'desc'=>'Khám phá làng cổ của người Dao Đỏ với những ngôi nhà trình tường độc đáo, tìm hiểu tập tục cưới hỏi, lễ cấp sắc và nghề thuốc nam gia truyền nổi tiếng.'],
            ['name'=>'Homestay Làng Văn Hóa Nặm Đăm',     'location'=>'Quản Bạ, Hà Giang',     'type'=>'ban_lang',    'price'=>1900000,
             'desc'=>'Ngủ đêm tại nhà trình tường đất nện của người Dao áo dài, xông hơi lá thuốc truyền thống, thưởng thức thắng cố và lạp xưởng gác bếp trong không gian bản làng yên bình.'],
            ['name'=>'Bản H\'Mông Lũng Cú Cực Bắc',       'location'=>'Đồng Văn, Hà Giang',    'type'=>'ban_lang',    'price'=>2500000,
             'desc'=>'Thăm bản làng người H\'Mông tại cực Bắc Tổ quốc, leo lên cột cờ Lũng Cú, tìm hiểu cuộc sống thường ngày và thưởng thức bữa cơm gia đình bản địa ấm cúng.'],

            // ── THIÊN NHIÊN: 750k → 3.200k ───────────────────────────────
            ['name'=>'Hồ Noong Xanh Biếc Vị Xuyên',       'location'=>'Vị Xuyên, Hà Giang',    'type'=>'thien_nhien', 'price'=>750000,
             'desc'=>'Khám phá hồ Noong trong xanh như ngọc bích ẩn mình giữa rừng già, chèo thuyền trên mặt hồ phẳng lặng và tắm suối khoáng tự nhiên trong lành.'],
            ['name'=>'Thung Lũng Quản Bạ Núi Đôi Cô Tiên','location'=>'Quản Bạ, Hà Giang',     'type'=>'thien_nhien', 'price'=>1100000,
             'desc'=>'Ngắm nhìn Núi Đôi Cô Tiên huyền thoại từ đỉnh Cổng Trời Quản Bạ, dạo bước qua thung lũng xanh mướt và tìm hiểu truyền thuyết về hai ngọn núi đôi kỳ bí.'],
            ['name'=>'Rừng Nguyên Sinh Du Già Yên Minh',   'location'=>'Yên Minh, Hà Giang',    'type'=>'thien_nhien', 'price'=>1450000,
             'desc'=>'Khám phá khu rừng nguyên sinh Du Già với hệ sinh thái đa dạng, ngắm thác nước hùng vĩ, tìm hiểu các loài thực vật quý hiếm và trải nghiệm cắm trại giữa rừng già.'],
            ['name'=>'Ruộng Bậc Thang Hoàng Su Phì Mùa Vàng','location'=>'Hoàng Su Phì, Hà Giang','type'=>'thien_nhien','price'=>1800000,
             'desc'=>'Chiêm ngưỡng những thửa ruộng bậc thang vàng óng trải dài trên sườn núi — một trong những danh thắng quốc gia đẹp nhất Việt Nam vào mùa lúa chín tháng 9-10.'],
            ['name'=>'Sông Nho Quế Hẻm Vực Tu Sản',       'location'=>'Mèo Vạc, Hà Giang',     'type'=>'thien_nhien', 'price'=>2300000,
             'desc'=>'Ngắm nhìn hẻm vực Tu Sản sâu nhất Đông Nam Á từ trên cao, chèo thuyền trên dòng sông Nho Quế xanh ngọc uốn lượn giữa vách đá dựng đứng hàng trăm mét.'],
            ['name'=>'Đỉnh Tây Côn Lĩnh Biển Mây Hoàng Su Phì','location'=>'Hoàng Su Phì, Hà Giang','type'=>'thien_nhien','price'=>3200000,
             'desc'=>'Chinh phục đỉnh Tây Côn Lĩnh cao 2.419m — đỉnh núi cao nhất tỉnh Hà Giang, ngắm biển mây bồng bềnh và toàn cảnh núi rừng Đông Bắc hùng vĩ từ trên đỉnh.'],

            // ── MẠO HIỂM: 1.500k → 5.000k ────────────────────────────────
            ['name'=>'Cắm Trại Đỉnh Đèo Cao Nguyên Đá',   'location'=>'Đồng Văn, Hà Giang',    'type'=>'mao_hiem',    'price'=>1500000,
             'desc'=>'Cắm trại qua đêm trên đỉnh đèo cao nguyên đá, ngắm hoàng hôn và bình minh tuyệt đẹp, quan sát bầu trời đầy sao và trải nghiệm cảm giác sống giữa thiên nhiên hoang dã.'],
            ['name'=>'Đua Xe Địa Hình Cung Đường Đèo Bắc Hà','location'=>'Bắc Hà, Hà Giang',   'type'=>'mao_hiem',    'price'=>2000000,
             'desc'=>'Trải nghiệm lái xe địa hình off-road trên cung đường đèo quanh co Bắc Hà, vượt qua những con dốc dựng đứng và đường mòn rừng núi với hướng dẫn viên kinh nghiệm.'],
            ['name'=>'Trekking Đèo Mã Pí Lèng Vách Đá Trắng','location'=>'Mèo Vạc, Hà Giang',  'type'=>'mao_hiem',    'price'=>2600000,
             'desc'=>'Chinh phục cung đường trekking men theo vách đá trắng dựng đứng trên đèo Mã Pí Lèng, ngắm hẻm vực Tu Sản sâu nhất Đông Nam Á và cắm trại trên đỉnh đèo huyền thoại.'],
            ['name'=>'Chèo Thuyền Kayak Sông Nho Quế',    'location'=>'Mèo Vạc, Hà Giang',     'type'=>'mao_hiem',    'price'=>3200000,
             'desc'=>'Chèo thuyền kayak trên dòng sông Nho Quế xanh ngọc, vượt qua những đoạn thác ghềnh nhẹ, khám phá các hang động ven sông và ngắm vách đá dựng đứng hai bên bờ.'],
            ['name'=>'Leo Núi Chinh Phục Đỉnh Tây Côn Lĩnh','location'=>'Hoàng Su Phì, Hà Giang','type'=>'mao_hiem',  'price'=>3900000,
             'desc'=>'Hành trình leo núi 2 ngày 1 đêm chinh phục đỉnh Tây Côn Lĩnh 2.419m với hướng dẫn viên chuyên nghiệp, thiết bị leo núi đầy đủ và trải nghiệm cắm trại trên đỉnh núi.'],
            ['name'=>'Bay Dù Lượn Thung Lũng Quản Bạ',    'location'=>'Quản Bạ, Hà Giang',     'type'=>'mao_hiem',    'price'=>5000000,
             'desc'=>'Cùng phi công chuyên nghiệp cất cánh từ đỉnh núi, bay lượn tự do trên bầu trời Quản Bạ, thu trọn Núi Đôi Cô Tiên và cánh đồng lúa chín vàng vào tầm mắt.'],
        ];

        $destinationImages = [
            'van_hoa' => [
                'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=1200',
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200',
                'https://images.unsplash.com/photo-1541776735-5c9753657cdf?w=1200',
            ],
            'lang_nghe' => [
                'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=1200',
                'https://images.unsplash.com/photo-1505685296765-3a2736de412f?w=1200',
                'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=1200',
            ],
            'ban_lang' => [
                'https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=1200',
                'https://images.unsplash.com/photo-1494526585095-c41746248156?w=1200',
                'https://images.unsplash.com/photo-1500534623283-312aade485b7?w=1200',
            ],
            'thien_nhien' => [
                'https://images.unsplash.com/photo-1528127269322-539801943592?w=1200',
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200',
                'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=1200',
            ],
            'mao_hiem' => [
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200',
                'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?w=1200',
                'https://images.unsplash.com/photo-1483683804023-6ccdb62f86ef?w=1200',
            ],
        ];

        $householdImages = [
            'van_hoa' => [
                'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=800',
                'https://images.unsplash.com/photo-1541776735-5c9753657cdf?w=800',
            ],
            'lang_nghe' => [
                'https://images.unsplash.com/photo-1505685296765-3a2736de412f?w=800',
                'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800',
            ],
            'ban_lang' => [
                'https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=800',
                'https://images.unsplash.com/photo-1500534623283-312aade485b7?w=800',
            ],
            'thien_nhien' => [
                'https://images.unsplash.com/photo-1528127269322-539801943592?w=800',
                'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=800',
            ],
            'mao_hiem' => [
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?w=800',
            ],
        ];

        $serviceImages = [
            'luu_tru' => [
                'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800',
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
            ],
            'an_uong' => [
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800',
                'https://images.unsplash.com/photo-1478145046317-39f10e56b5e9?w=800',
            ],
        ];

        foreach ($tours as $t) {
            $price = $t['price'];
            $destinationImage = $destinationImages[$t['type']][array_rand($destinationImages[$t['type']])];
            $householdImage = $householdImages[$t['type']][array_rand($householdImages[$t['type']])];

            $dest = Destination::firstOrCreate(
                ['name' => $t['name']],
                [
                    'location'    => $t['location'],
                    'type'        => $t['type'],
                    'description' => $t['desc'],
                    'image'       => $destinationImage,
                    'is_active'   => true,
                ]
            );

            if (!$dest->image) {
                $dest->update(['image' => $destinationImage]);
            }

            // Dịch vụ chính (homestay/trải nghiệm) — giá = giá tour
            $serviceImage = $serviceImages['luu_tru'][array_rand($serviceImages['luu_tru'])];
            Service::firstOrCreate(
                ['destination_id' => $dest->id, 'type' => 'luu_tru'],
                [
                    'destination_id' => $dest->id,
                    'name'           => 'Gói trải nghiệm ' . $dest->name,
                    'type'           => 'luu_tru',
                    'description'    => 'Gói trải nghiệm đầy đủ bao gồm hướng dẫn viên bản địa, ăn uống và lưu trú.',
                    'price'          => $price,
                    'image'          => $serviceImage,
                    'is_active'      => true,
                ]
            );

            if (!$dest->services()->where('type', 'luu_tru')->value('image')) {
                $dest->services()->where('type', 'luu_tru')->first()->update(['image' => $serviceImage]);
            }

            $serviceFoodImage = $serviceImages['an_uong'][array_rand($serviceImages['an_uong'])];
            Service::firstOrCreate(
                ['destination_id' => $dest->id, 'type' => 'an_uong'],
                [
                    'destination_id' => $dest->id,
                    'name'           => 'Ẩm thực đặc sản ' . $t['location'],
                    'type'           => 'an_uong',
                    'description'    => 'Thưởng thức các món ăn đặc sản địa phương do chính tay người dân bản địa chế biến.',
                    'price'          => (int)round($price * 0.12 / 50000) * 50000,
                    'image'          => $serviceFoodImage,
                    'is_active'      => true,
                ]
            );
            if (!$dest->services()->where('type', 'an_uong')->value('image')) {
                $dest->services()->where('type', 'an_uong')->first()->update(['image' => $serviceFoodImage]);
            }

            // Hộ dân
            $household = Household::firstOrCreate(
                ['destination_id' => $dest->id],
                [
                    'destination_id' => $dest->id,
                    'owner_name'     => 'Hộ dân ' . $t['location'],
                    'phone'          => '0912.345.678',
                    'address'        => $t['location'],
                    'description'    => 'Hộ dân tham gia chương trình du lịch cộng đồng, cung cấp dịch vụ lưu trú và ăn uống.',
                    'image'          => $householdImage,
                    'is_active'      => true,
                ]
            );

            if (!$household->image) {
                $household->update(['image' => $householdImage]);
            }
        }
    }
}
