<?php

namespace App\Models\Traits;

trait HasImageUrl
{
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        if (preg_match('/^(?:https?:)?\/\//i', $this->image)) {
            return $this->image;
        }

        return asset('storage/' . ltrim($this->image, '/'));
    }
}
