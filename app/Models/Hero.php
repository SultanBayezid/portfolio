<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $table = 'heroes';

    protected $fillable = [
        'display_name',
        'status_badge',
        'avatar_initials',
        'sub_line',
        'hire_btn_label',
        'hire_btn_url',
        'view_work_label',
        'view_work_target',
        'facebook_url',
        'linkedin_url',
        'youtube_url',
        'github_url',
        'website_url',
        'typing_words',
        'section_label',
        'blob_color_1',
        'blob_color_2',
        'avatar_gradient',
    ];

    protected $casts = [
        'typing_words' => 'array',
    ];
}
