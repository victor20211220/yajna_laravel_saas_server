<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'created_by'

    ];
}
