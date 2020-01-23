<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    
    protected $table = 'arsip';

    protected $appends = [
        'ekstensi_berkas_label',
    ];
    
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
        'disk',
        'keterangan',
        'maksud_surat',
    ];

    public function getEkstensiBerkasLabelAttribute()
    {
        if(in_array($this->ekstensi_berkas, ['pdf','ppt']))
            return '<span class="badge badge-danger">'.$this->ekstensi_berkas.'</span>';
        if(in_array($this->ekstensi_berkas, ['xls','xlsx']))
            return '<span class="badge badge-success">'.$this->ekstensi_berkas.'</span>';
        if(in_array($this->ekstensi_berkas, ['doc','docx']))
            return '<span class="badge badge-primary">'.$this->ekstensi_berkas.'</span>';
    }
    
}
