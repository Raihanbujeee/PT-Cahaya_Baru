<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyStats extends Model
{
    protected $table = 'company_stats';
    protected $fillable = ['label', 'value'];
}
