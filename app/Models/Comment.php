<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'product_comments';
    protected $fillable = [
        'body',
        'rating',
        'status',
        'user_id',
        'product_id',
    ];
}