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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('dt_hr_visita')->nullable();
            $table->text('ds_visita')->nullable();
            $table->text('ds_resumo')->nullable();
            $table->string('nr_cep')->nullable();
            $table->text('ds_endereco')->nullable();
            $table->text('nr_endereco')->nullable();
            $table->text('ds_complemento')->nullable();
            $table->text('ds_bairro')->nullable();
            $table->text('nm_cidade')->nullable();
            $table->text('ds_uf')->nullable();
            $table->string('st_visita');
            $table->longText('audio_base64')->nullable();
            $table->string('audio_whats')->nullable();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
