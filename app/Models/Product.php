<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'sku', 'tags', 'description', 'image', 'price', 'sale_price', 'cost_per_piece', 'discount_start', 'discount_end', 'stock', 'allowed_quantity', 'is_visible', 'is_feature', 'available_start', 'product_category_id', 'created_by'];

    protected $casts = [
        'tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function images()
    {
        return $this->morphToMany(Images::class, 'imageable');
    }
}
