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
        Schema::create('reuniaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('familia_id')->nullable();
            $table->unsignedBigInteger('membro_id')->nullable();
            $table->string('tp_reuniao');
            $table->dateTime('dt_hr_reuniao');
            $table->integer('tempo_reuniao');
            $table->text('ds_reuniao');
            $table->text('ds_parecer')->nullable();
            $table->string('st_reuniao');
            $table->longText('audio_base64');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('familia_id')->references('id')->on('familias');
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reuniaos');
    }
};
