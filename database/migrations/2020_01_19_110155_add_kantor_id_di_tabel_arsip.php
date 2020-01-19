<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKantorIdDiTabelArsip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arsip', function (Blueprint $table) {
            $table->bigInteger('kantor_id')->unsigned();
            $table->foreign('kantor_id')->on('kantor')->references('id')->onUpdate('cascade')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('arsip', function (Blueprint $table) {
            $table->dropForeign(['kantor_id']);
        });
        Schema::table('arsip', function (Blueprint $table) {
            $table->dropColumn(['kantor_id']);
        });
    }
}
