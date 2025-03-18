<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('situacao');
            $table->string('nome');
            $table->string('genero');
            $table->string('fone')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->date('data_batismo')->nullable();
            $table->string('cooperador')->nullable();
            $table->string('igreja_anterior')->nullable();
            $table->string('funcao')->nullable();
            $table->date('dt_nascimento')->nullable();
            $table->text('alergico')->nullable();
            $table->text('obs')->nullable();
            $table->string('como_veio')->nullable();
            $table->string('postar_redes')->nullable();
            $table->string('aceita_msg')->nullable();
            $table->string('recebeu_lembranca')->nullable();
            $table->longText('audio_base64')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros');
    }
};
