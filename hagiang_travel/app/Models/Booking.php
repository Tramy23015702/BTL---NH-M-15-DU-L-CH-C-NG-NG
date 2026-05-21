<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'tour_name', 'num_people', 'member_names', 'services', 'total_price', 'status', 'note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusNameAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
            default     => 'Không xác định',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            default     => 'secondary',
        };
    }
}
