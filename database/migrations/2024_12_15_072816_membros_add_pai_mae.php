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
        Schema::table('membros', function($table){
            $table->unsignedBigInteger('pai_id')->nullable();
            $table->unsignedBigInteger('mae_id')->nullable();
            $table->foreign('pai_id')->references('id')->on('membros');
            $table->foreign('mae_id')->references('id')->on('membros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
