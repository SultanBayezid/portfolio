<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $table = 'seos';

    protected $fillable = [
        'page_title',
        'meta_description',
        'keywords',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'twitter_handle',
        'ga4_id',
        'gsc_verify',
        'fb_pixel',
        'hotjar_id',
        'schema_type',
        'json_ld',
    ];
}
