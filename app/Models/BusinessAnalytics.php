<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessAnalytics extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'business_id',
        'type',
        'source',
        'category',
        'created_at',
    ];
}
