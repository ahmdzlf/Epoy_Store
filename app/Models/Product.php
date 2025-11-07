<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'detail',
        'price',
        'stock',
        'sku',
        'gender',
        'is_featured',
        'is_new',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Scopes (opsional, tapi sangat membantu)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔽 TAMBAHKAN relasi ini
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function heroBanners()
    {
        return $this->hasMany(HeroBanner::class);
    }
    
    // Helper untuk get primary image
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)
                    ->where('is_primary', true)
                    ->orWhere(function($q) {
                        $q->orderBy('sort_order');
                    });
    }
    // 🔼 SAMPAI SINI

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor
    public function getIsInStockAttribute()
    {
        return $this->stock > 0;
    }
}
