<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramSetting extends Model
{
    protected $fillable = [
        'id',              // tambahkan ini!
        'bot_token',
        'bot_name',
        'webhook_url',
    ];
}
