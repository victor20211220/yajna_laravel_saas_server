<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplateLang extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'lang',
        'subject',
        'content'
    ];
}
