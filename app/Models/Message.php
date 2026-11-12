<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'body',
        'initials',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Get a short formatted time for display in the inbox list.
     */
    public function getTimeShortAttribute(): string
    {
        return $this->created_at->format('M d, H:i');
    }
}
