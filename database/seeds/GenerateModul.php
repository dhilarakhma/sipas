<?php

use Illuminate\Database\Seeder;
use App\Models\Modul;

class GenerateModul extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('modul')->truncate();
    	$i = 1;
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'dashboard',
            'label'     => 'Dashboard',
        	'ikon'		=> 'fa fa-fire',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'profil',
            'label'     => 'Profil',
        	'ikon'		=> 'fa fa-user',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'contoh',
            'label'     => 'Contoh',
        	'ikon'		=> 'fa fa-atom',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'surat_masuk',
            'label'     => 'Surat Masuk',
        	'ikon'		=> 'fa fa-envelope-open',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'surat_keluar',
            'label'     => 'Surat Keluar',
        	'ikon'		=> 'fa fa-envelope',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'pegawai',
            'label'     => 'Pegawai',
        	'ikon'		=> 'fa fa-user-friends',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'organisasi',
            'label'     => 'Organisasi',
        	'ikon'		=> 'fa fa-users',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'kantor',
            'label'     => 'Kantor',
        	'ikon'		=> 'fa fa-university',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'pengaturan',
            'label'     => 'Pengaturan',
        	'ikon'		=> 'fa fa-cogs',
        ]);
        Modul::create([
        	'id'		=> $i++,
            'nama'		=> 'keluar',
            'label'     => 'Keluar',
        	'ikon'		=> 'fa fa-sign-out',
        ]);
    }
}
