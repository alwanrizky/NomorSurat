<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtrTemplateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atr_template_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_template_surat')->constrained('template_surats');
            $table->foreignId('id_atr_surat')->constrained('atr_surats');
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
        Schema::dropIfExists('atr_template_surat');
    }
}
