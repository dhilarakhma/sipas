<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('kantor')->truncate();
        $waktu = date('Y-m-d H:i:s');
        $data = [];
        $i = 2;
        $user = [
            'nama'     => 'ADMIN KANTOR PUSAT',
            // 'email'    => 'kantor_pusat@nururrohmah.com',
            'email'    => 'kantor_pusat@kantor.com',
            'password' => bcrypt('12345'),
            'avatar'   => asset('stisla/assets/img/avatar/avatar-1.png'),
            'role'     => 'admin'
        ];
        $user = \App\User::updateOrCreate([
            'id'    => $i++,
        ], $user);
        $data[] = [
            'nama'      => 'KANTOR PUSAT',
            'user_id'   => $user->id,
        ];
        $user = [
            'nama'     => 'ADMIN CABANG UTAMA',
            // 'email'    => 'cabang_utama@nururrohmah.com',
            'email'    => 'cabang_utama@kantor.com',
            'password' => bcrypt('12345'),
            'avatar'   => asset('stisla/assets/img/avatar/avatar-1.png'),
            'role'     => 'admin'
        ];
        $user = \App\User::updateOrCreate([
            'id'    => $i++,
        ], $user);
        $data[] = [
            'nama'      => 'CABANG UTAMA',
            'user_id'   => $user->id,
        ];
        $user = [
            'nama'     => 'ADMIN CABANG AYAH',
            // 'email'    => 'cabang_ayah@nururrohmah.com',
            'email'    => 'cabang_ayah@kantor.com',
            'password' => bcrypt('12345'),
            'avatar'   => asset('stisla/assets/img/avatar/avatar-1.png'),
            'role'     => 'admin'
        ];
        $user = \App\User::updateOrCreate([
            'id'    => $i++,
        ], $user);
        $data[] = [
            'nama'      => 'CABANG AYAH',
            'user_id'   => $user->id,
        ];
        DB::table('kantor')->insert($data);
    }
}
