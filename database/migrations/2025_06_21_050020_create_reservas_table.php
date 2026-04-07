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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('culto_id');
            $table->unsignedBigInteger('membro_id')->nullable();
            $table->string('tp_reserva');
            $table->text('nm_convite')->nullable();
            $table->string('presenca_convite', 5)->default('Não');
            $table->foreign('culto_id')->references('id')->on('cultos');
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
