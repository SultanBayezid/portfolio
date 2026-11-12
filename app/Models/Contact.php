<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'section_label',
        'section_heading',
        'subtext',
        'form_action',
        'button_label',
        'show_name',
        'show_email',
        'show_subject',
        'show_message',
        'recaptcha_key',
        'notification_email',
        'auto_reply',
    ];

    protected $casts = [
        'show_name'    => 'boolean',
        'show_email'   => 'boolean',
        'show_subject' => 'boolean',
        'show_message' => 'boolean',
    ];
}
