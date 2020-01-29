<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_surat')->nullable();
            $table->string('no_surat')->nullable();
            $table->bigInteger('jenis_dokumen_id')->unsigned();
            $table->foreign('jenis_dokumen_id')->on('jenis_dokumen')->references('id')->onUpdate('cascade')->onDelete("cascade");
            $table->string('pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('berkas');
            $table->string('nama_berkas');
            $table->string('ekstensi_berkas');
            $table->text('keterangan')->nullable();
            $table->string('maksud_surat')->nullable();
            $table->string('acara')->nullable();
            $table->string('tempat')->nullable();
            $table->string('pengundang')->nullable();
            $table->string('delegasi_hadir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip');
    }
}
