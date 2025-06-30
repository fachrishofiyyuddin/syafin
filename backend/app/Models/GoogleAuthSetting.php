<?php

// app/Models/GoogleAuthSetting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleAuthSetting extends Model
{
    protected $fillable = ['client_id', 'client_secret', 'redirect_uri'];
}
