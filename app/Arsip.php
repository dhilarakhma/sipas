<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    
    protected $table = 'arsip';
    
    protected $fillable = [
        'no_surat',
        'judul_surat',
        'jenis_dokumen_id',
        'pengirim',
        'penerima',
        'tanggal',
        'berkas',
        'nama_berkas',
        'ekstensi_berkas',
        'kantor_id',
    ];
    
}
