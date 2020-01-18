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
