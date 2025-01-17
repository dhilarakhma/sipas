<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
    	'key', 'value', 'form_type', 'grup', 'grup_label', 'pilihan',
    ];

    public $timestamps = false;

    protected $casts = [
        'pilihan'   => 'array',
    ];

}
