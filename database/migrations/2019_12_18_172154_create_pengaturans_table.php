<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('key');
            $table->text('value');
            $table->string('form_type')->default('text');
            $table->string('grup')->default('pengaturan_umum');
            $table->string('grup_label')->default('Pengaturan Umum');
            $table->string('ikon')->default('fas fa-cog');
            $table->string('label')->default('Pengaturan apa hayo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturan');
    }
}
