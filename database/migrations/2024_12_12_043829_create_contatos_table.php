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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membro_id');
            $table->dateTime('dt_hr_contato');
            $table->text('ds_contato')->nullable();
            $table->longText('audio_base64')->nullable();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('contatos');
    }
};
