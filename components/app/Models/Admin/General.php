<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;
    protected $table = 'generals';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'parallax_status'              => 'boolean',
        'maintenance_mode'             => 'boolean',
        'theme_mode'                   => 'boolean',
        'rtl_mode'                     => 'boolean',
        'adblock_detection'            => 'boolean',
        'automatic_language_detection' => 'boolean',
        'recaptcha_v3'                 => 'boolean',
        'language_switcher'            => 'boolean',
        'page_load'                    => 'boolean',
        'supported_sites'              => 'boolean',
        'share_icons_status'           => 'boolean',
        'search_box_status'            => 'boolean',
        'author_box_status'            => 'boolean',
        'social_status'                => 'boolean',
    ];
}
