<?php

namespace App\Models;

use App\Models\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $fillable = ['destination_id', 'owner_name', 'phone', 'address', 'description', 'image', 'is_active'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    use HasImageUrl;
}
