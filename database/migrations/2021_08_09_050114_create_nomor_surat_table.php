<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomorSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomor_surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('kepada');
            $table->string('perihal');
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_tipe_surat')->constrained('tipe_surats');
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
        Schema::dropIfExists('nomor_surats');
    }
}
