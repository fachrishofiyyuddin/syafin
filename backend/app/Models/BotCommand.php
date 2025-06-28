<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotCommand extends Model
{
    use HasFactory;

    protected $table = 'bot_commands'; // opsional kalau nama tabel 'admin'

    protected $fillable = ['command', 'label', 'response', 'is_active'];
}
