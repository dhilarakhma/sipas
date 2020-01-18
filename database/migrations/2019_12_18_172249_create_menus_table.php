<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama');
            $table->string('route');
            $table->string('ikon');
            $table->string('is_blank')->nullable();
            $table->tinyInteger('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->on('menu')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
