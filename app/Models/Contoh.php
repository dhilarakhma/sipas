<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contoh extends Model
{
    protected $table = 'contoh';

    protected $fillable = [
        'ini_text', 'ini_email', 'ini_datepicker', 'ini_gambar', 'ini_excel', 'ini_file', 'ini_textarea', 'ini_select', 'ini_select2', 'ini_password', 'ini_number',
    ];

    public $timestamps = false;

}
