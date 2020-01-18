<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = 'modul';

    protected $fillable = [
    	'nama', 'ikon', 'label',
    ];

    public $timestamps = false;

}
