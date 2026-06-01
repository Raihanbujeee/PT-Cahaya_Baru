<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContents extends Model
{
    protected $table = 'about_contents';
    protected $fillable = ['title', 'description', 'image','link'];
}
