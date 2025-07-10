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
        Schema::create('post_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->comment('Ид поста.');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->dateTime('send_planed_date')->comment("Запланированная дата постинга.");
            $table->dateTime('send_actual_date')->comment("Фактическая дата размещения поста.");
            $table->timestamps();
            $table->comment('Запланированные даты постинга.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_schedules');
    }
};
