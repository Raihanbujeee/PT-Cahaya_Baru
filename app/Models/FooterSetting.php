<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
    'description', 'address', 'phone', 'email', 'hours', 'social_links'
];

protected $casts = [
    'social_links' => 'array',
];
}
