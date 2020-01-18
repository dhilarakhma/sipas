<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContohTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contoh', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('ini_text');
            $table->string('ini_number');
            $table->string('ini_email');
            $table->string('ini_datepicker');
            $table->string('ini_gambar');
            $table->string('ini_excel');
            $table->string('ini_file');
            $table->text('ini_textarea');
            $table->string('ini_select');
            $table->string('ini_select2');
            $table->string('ini_password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contoh');
    }
}
