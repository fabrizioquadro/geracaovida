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
        Schema::create('culto_presencas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('culto_id');
            $table->unsignedBigInteger('membro_id');
            $table->string('presenca_oracao')->nullable();
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
        Schema::dropIfExists('culto_presencas');
    }
};
