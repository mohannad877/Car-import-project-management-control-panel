<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'grade',
        'mileage',
        'condition_status',
        'auction_price',
        'estimated_cost',
        'currency',
        'location',
        'transmission',
        'engine',
        'fuel',
        'drive_type',
        'color',
        'vin',
        'lot_number',
        'image_url',
        'images',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'mileage' => 'integer',
            'auction_price' => 'decimal:2',
            'estimated_cost' => 'decimal:2',
            'images' => 'array',
        ];
    }

    /**
     * Get the primary image for display
     * Returns the first uploaded image or the image_url
     */
    public function getPrimaryImageAttribute()
    {
        // If there are uploaded images, return the first one from storage
        if (!empty($this->images) && is_array($this->images) && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }

        // Otherwise, return the external image_url
        if (!empty($this->image_url)) {
            return $this->image_url;
        }

        // Return null if no image is available
        return null;
    }
}
