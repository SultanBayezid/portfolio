<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireBanner extends Model
{
    use HasFactory;

    protected $table = 'hire_banners';

    protected $fillable = [
        'heading',
        'subtext',
        'button_label',
        'button_url',
        'button_icon',
        'visible',
        'gradient_start',
        'gradient_end',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];
}
