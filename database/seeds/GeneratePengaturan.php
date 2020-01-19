<?php

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class GeneratePengaturan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pengaturan')->truncate();
    	$i = 1;
        Pengaturan::create([
            'key'       => 'tahun',
            'value'     => '2020',
            'ikon'      => 'fas fa-calendar',
            'label'     => 'Tahun',
        ]);
        Pengaturan::create([
            'key'       => 'nama_perusahaan',
            'value'     => 'KSPSS NURURROHMAH AL BAROKAH',
            'ikon'      => 'fas fa-building',
            'label'     => 'Nama Perusahaan',
        ]);
        Pengaturan::create([
            'key'       => 'kota',
            'value'     => 'Jember',
            'ikon'      => 'fas fa-city',
            'label'     => 'Kota',
        ]);
        Pengaturan::create([
            'key'       => 'negara',
            'value'     => 'Indonesia',
            'ikon'      => 'fas fa-flag',
            'label'     => 'Negara',
        ]);
        Pengaturan::create([
            'key'       => 'logo',
            'value'     => url('stisla/assets/img/stisla-fill.png'),
            'ikon'      => 'fas fa-atom',
            'label'     => 'Logo',
            'form_type' => 'image',
        ]);
        Pengaturan::create([
            'key'       => 'favicon',
            'value'     => url('stisla/assets/img/favicon.ico'),
            'ikon'      => 'fas fa-heart',
            'label'     => 'Favicon',
            'form_type' => 'image',
        ]);
        Pengaturan::create([
            'key'       => 'background_masuk',
            'value'     => url('stisla/assets/img/pantai.jpg'),
            'ikon'      => 'fas fa-image',
            'label'     => 'Background Masuk',
            'form_type' => 'image',
        ]);
        Pengaturan::create([
            'key'       => 'sidebar_mini',
            'value'     => 'true',
            'label'     => 'Sidebar Mini',
            'form_type' => 'select2',
            'pilihan'   => [
                'true' => 'true',
                'false' => 'false',
            ]
        ]);
        // meta
        Pengaturan::create([
            'key'               => 'meta_description',
            'value'             => 'KSPSS NURURROHMAH AL BAROKAH',
            'ikon'              => 'fas fa-globe',
            'label'             => 'Meta Description',
            'grup_label'        => 'Pengaturan Meta',
            'grup'              => 'pengaturan_meta',
        ]);
        Pengaturan::create([
            'key'               => 'meta_keywords',
            'value'             => 'Sistem Informasi, Pemrograman, Github, PHP, Laravel, Stisla, Heroku, Koperasi, Nururrohmah',
            'ikon'              => 'fas fa-globe',
            'label'             => 'Meta Keywords',
            'grup_label'        => 'Pengaturan Meta',
            'grup'              => 'pengaturan_meta',
        ]);
    }
}
