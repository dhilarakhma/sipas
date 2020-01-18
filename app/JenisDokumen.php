<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{

    protected $table = 'jenis_dokumen';

    protected $fillable = [
        'nama', 'route',
    ];

}
