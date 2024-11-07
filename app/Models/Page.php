<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pages';

    protected $fillable = ['page_category_id', 'title', 'slug', 'content', 'status', 'meta'];


    public function pageCategory()
    {
        return $this->belongsTo(PageCategory::class, 'page_category_id', 'id');
    }
}