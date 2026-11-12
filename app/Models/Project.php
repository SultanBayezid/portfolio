<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'url',
        'initials',
        'color_start',
        'color_end',
        'categories',
        'description',
        'github_url',
        'technologies',
        'year',
        'status',
    ];

    protected $appends = ['tag_list'];

    /**
     * Get the tags as an array for display in Blade.
     */
    public function getTagListAttribute(): array
    {
        $tags = [];
        $categories = explode(' ', $this->categories ?? '');
        foreach ($categories as $cat) {
            if (empty($cat)) continue;
            $label = ucfirst(preg_replace('/([A-Z])/', ' $1', $cat));
            $tags[] = ['label' => trim($label), 'class' => ''];
        }
        if ($this->status && $this->status !== 'Live') {
            $tags[] = ['label' => $this->status, 'class' => 'wa'];
        }
        return $tags;
    }
}
