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
        Schema::create('familia_filhos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familia_id');
            $table->unsignedBigInteger('filho_id');
            $table->foreign('familia_id')->references('id')->on('familias');
            $table->foreign('filho_id')->references('id')->on('membros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('familia_filhos');
    }
};
