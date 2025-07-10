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
        Schema::create('reposter_channels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reposter_id')->comment("Ид репостера.");
            $table->foreign('reposter_id')
                ->references('id')
                ->on('reposters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('channel_username')->comment("Логин канала.");
            $table->timestamps();
            $table->comment('Каналы-ресурсы для репостера.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reposter_channels');
    }
};
