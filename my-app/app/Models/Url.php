<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'short_url', 'expired_at'];

    protected $casts = [
        'expired_at' => 'datetime',
    ];


    public static function generateShortUrl($url)
    {
        return substr(md5($url), 0, 8);
    }
}
