<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareContactField extends Model
{
    protected $fillable = [
        'business_id',
        'is_name_required',
        'is_name_enabled',
        'is_phone_required',
        'is_phone_enabled',
        'is_email_required',
        'is_email_enabled',
        'is_company_required',
        'is_company_enabled',
        'is_job_title_required',
        'is_job_title_enabled',
        'is_notes_required',
        'is_notes_enabled',
    ];
}
