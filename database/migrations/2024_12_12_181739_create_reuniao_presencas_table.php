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
        Schema::create('reuniao_presencas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reuniao_id');
            $table->unsignedBigInteger('membro_id');
            $table->foreign('reuniao_id')->references('id')->on('reuniaos');
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reuniao_presencas');
    }
};
