<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MidtransSetting extends Model
{
    protected $fillable = [
        'server_key',
        'client_key',
        'is_production',
    ];
}
