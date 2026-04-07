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
        Schema::create('cultos', function (Blueprint $table) {
            $table->id();
            $table->string('nm_culto');
            $table->dateTime('dt_hr_culto');
            $table->text('ds_culto')->nullable();
            $table->text('ds_parecer')->nullable();
            $table->string('st_culto');
            $table->string('tp_culto');
            $table->longText('audio_base64')->nullable();
            $table->unsignedBigInteger('ministerio_id')->nullable();
            $table->integer('nr_vagas')->nullable();
            $table->foreign('ministerio_id')->references('id')->on('ministerios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultos');
    }
};
