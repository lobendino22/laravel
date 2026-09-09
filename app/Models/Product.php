<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'photo',
    ];

    /**
     * The photo is either an uploaded filename inside /_uploads
     * or a full image URL (e.g. a Google Images link).
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if ($this->photo === null || $this->photo === '') {
            return null;
        }

        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
            return $this->photo;
        }

        return asset('_uploads/' . $this->photo);
    }
}
