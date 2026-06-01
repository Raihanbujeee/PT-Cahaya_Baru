<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreValues extends Model
{
    protected $table = 'core_values';
    protected $fillable = ['title', 'description', 'icon'];
}
