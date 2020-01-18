<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenerateAdmin::class);
        $this->call(GenerateMenu::class);
        $this->call(GenerateModul::class);
        $this->call(GeneratePengaturan::class);
        $this->call(ContohSeeder::class);
    }
}
