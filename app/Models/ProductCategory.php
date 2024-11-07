<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_categories';

    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'parent_id', 'created_by'];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }
}
