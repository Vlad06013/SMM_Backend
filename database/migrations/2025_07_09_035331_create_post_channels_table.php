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
        Schema::create('post_channels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->comment('Ид поста.');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('channel_id')->comment('Ид канала.');
            $table->foreign('channel_id')
                ->references('id')
                ->on('client_channels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('status_send')->nullable()->comment('Статус отправки.');
            $table->unique(['post_id', 'channel_id']);
            $table->timestamps();
            $table->comment('Каналы постов');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_channels');
    }
};
