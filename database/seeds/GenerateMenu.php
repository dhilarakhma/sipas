<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class GenerateMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menu')->truncate();
    	$i = 1;
        Menu::create([
        	'id'		=> $i++,
        	'nama'		=> 'Dashboard',
        	'ikon'		=> 'fas fa-fire',
        	'route'		=> 'dashboard',
        ]);
        Menu::create([
        	'id'		=> $i++,
        	'nama'		=> 'Contoh',
        	'ikon'		=> 'fas fa-atom',
        	'route'		=> 'contoh.index',
        ]);
        Menu::create([
        	'id'		=> $i++,
        	'nama'		=> 'Profil',
        	'ikon'		=> 'fas fa-user',
        	'route'		=> 'profil',
        ]);
        Menu::create([
        	'id'		=> $i++,
        	'nama'		=> 'Pengaturan',
        	'ikon'		=> 'fas fa-cogs',
        	'route'		=> 'pengaturan',
        ]);
        Menu::create([
        	'id'		=> $i++,
        	'nama'		=> 'Keluar',
        	'ikon'		=> 'fas fa-sign-out-alt',
        	'route'		=> 'keluar',
        ]);
    }
}
