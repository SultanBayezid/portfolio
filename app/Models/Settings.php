<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'site_title',
        'site_logo',
        'copyright',
        'language',
        'timezone',
        'dark_mode_toggle',
        'dark_mode_default',
        'primary_accent',
        'secondary_accent',
        'heading_color',
        'background',
        'body_font',
        'heading_font',
        'filter_categories',
    ];

    protected $casts = [
        'dark_mode_toggle'   => 'boolean',
        'dark_mode_default'  => 'boolean',
        'filter_categories'  => 'array',
    ];
}
