<?php

use Illuminate\Database\Seeder;
use App\Models\Contoh;

class ContohSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        foreach (range(1, 10) as $i) {
            Contoh::create([
                'ini_text'			=> \Str::random(5),
                'ini_email'			=> $faker->email,
                'ini_number'		=> $faker->randomDigit,
                'ini_datepicker'	=> $faker->date,
                'ini_gambar'		=> 'public/ini_gambar/'.\Str::random(20).'.jpg',
                'ini_excel'			=> 'public/ini_excel/'.\Str::random(20).'.xlsx',
                'ini_file'			=> 'public/ini_file/'.\Str::random(20).'.pdf',
                'ini_textarea'		=> $faker->text,
                'ini_select'		=> $faker->randomElement(['Option 1', 'Option 2']),
                'ini_select2'		=> $faker->randomElement(['Option 1', 'Option 2']),
                'ini_password'		=> bcrypt(\Str::random(5)),
                ]
            );
        }
    }
}
