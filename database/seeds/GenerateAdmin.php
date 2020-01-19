<?php

use Illuminate\Database\Seeder;
use App\User;

class GenerateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
        	'id'	=> 1,
        ], [
        	'nama'			=> 'Hairul Anam',
        	'email'			=> 'admin@admin.com',
            'password'		=> bcrypt('admin'),
            'avatar'        => asset('stisla/assets/img/avatar/avatar-1.png'),
        ]);
    }
}
