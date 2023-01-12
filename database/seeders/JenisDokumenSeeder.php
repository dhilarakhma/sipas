<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('jenis_dokumen')->truncate();
        $waktu = date('Y-m-d H:i:s');
        $data = [];
        $data[] = [
            'nama'      => 'Surat Masuk',
            'route'     => \Str::snake(strtolower('Surat Masuk')),
        ];
        $data[] = [
            'nama'      => 'Surat Keluar',
            'route'     => \Str::snake(strtolower('Surat Keluar')),
        ];
        $data[] = [
            'nama'      => 'Pegawai',
            'route'     => \Str::snake(strtolower('Pegawai')),
        ];
        $data[] = [
            'nama'      => 'Organisasi',
            'route'     => \Str::snake(strtolower('Organisasi')),
        ];
        $data[] = [
            'nama'      => 'Undangan',
            'route'     => \Str::snake(strtolower('Undangan')),
        ];
        DB::table('jenis_dokumen')->insert($data);
    }
}
