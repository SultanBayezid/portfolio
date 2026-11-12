<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibility extends Model
{
    use HasFactory;

    protected $table = 'visibilities';

    protected $fillable = [
        'section_key',
        'section_name',
        'description',
        'visible',
        'type',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    /**
     * Type can be 'section', 'nav', or 'feature'.
     */
    public function scopeSections($query)
    {
        return $query->where('type', 'section');
    }

    public function scopeNav($query)
    {
        return $query->where('type', 'nav');
    }
}
