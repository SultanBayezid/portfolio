<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';

    protected $fillable = [
        'section_label',
        'section_title',
        'paragraph_1',
        'paragraph_2',
        'name',
        'place_of_birth',
        'nationality',
        'marital_status',
        'profession',
        'contact_no',
        'email',
        'location',
        'experience',
    ];
}
