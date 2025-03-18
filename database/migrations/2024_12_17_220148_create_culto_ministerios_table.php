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
        Schema::create('culto_ministerios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('culto_id');
            $table->unsignedBigInteger('ministerio_id');
            $table->foreign('culto_id')->references('id')->on('cultos');
            $table->foreign('ministerio_id')->references('id')->on('ministerios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culto_ministerios');
    }
};
