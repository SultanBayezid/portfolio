<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $fillable = [
        'name',
        'percentage',
        'type',
    ];

    /**
     * Type can be 'backend' or 'frontend'.
     */
    public function scopeBackend($query)
    {
        return $query->where('type', 'backend');
    }

    public function scopeFrontend($query)
    {
        return $query->where('type', 'frontend');
    }
}
