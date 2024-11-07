<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    use HasFactory;

    protected $table = 'app_settings';

    protected $fillable = [
        'app_name', 'app_url', 'app_logo', 'app_favicon', 'app_description', 'app_keywords', 'facebook_url', 'twitter_url', 'instagram_url', 'youtube_url', 'linkedin_url', 'telegram_num', 'app_email', 'app_phone', 'app_address', 'google_map_link'
    ];
}
