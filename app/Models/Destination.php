<?php

namespace App\Models;

use App\Models\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['name', 'location', 'type', 'description', 'image', 'map_link', 'is_active'];

    public function households()
    {
        return $this->hasMany(Household::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    use HasImageUrl;

    // 5 loại hình chính
    public static function typeList(): array
    {
        return [
            'van_hoa'     => 'Văn hóa',
            'lang_nghe'   => 'Làng nghề',
            'ban_lang'    => 'Bản làng',
            'thien_nhien' => 'Thiên nhiên',
            'mao_hiem'    => 'Mạo hiểm',
        ];
    }

    public function getTypeNameAttribute(): string
    {
        return self::typeList()[$this->type] ?? 'Khác';
    }

    public function getTypeBadgeColorAttribute(): string
    {
        return match($this->type) {
            'van_hoa'     => 'primary',
            'lang_nghe'   => 'warning',
            'ban_lang'    => 'success',
            'thien_nhien' => 'info',
            'mao_hiem'    => 'danger',
            default       => 'secondary',
        };
    }

    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'van_hoa'     => '🎭',
            'lang_nghe'   => '🧵',
            'ban_lang'    => '🏘️',
            'thien_nhien' => '🌿',
            'mao_hiem'    => '🏔️',
            default       => '📍',
        };
    }
}
