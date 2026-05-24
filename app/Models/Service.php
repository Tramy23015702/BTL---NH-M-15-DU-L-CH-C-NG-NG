<?php

namespace App\Models;

use App\Models\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['destination_id', 'name', 'type', 'description', 'price', 'image', 'is_active'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    use HasImageUrl;

    public function getTypeNameAttribute(): string
    {
        return match($this->type) {
            'luu_tru'    => 'Lưu trú / Homestay',
            'an_uong'    => 'Ăn uống',
            'trai_nghiem'=> 'Trải nghiệm',
            'lang_nghe'  => 'Làng nghề',
            default      => 'Khác',
        };
    }
}
