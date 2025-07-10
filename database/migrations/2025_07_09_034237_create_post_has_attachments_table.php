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
        Schema::create('post_has_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->comment('Ид поста.');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('attachment_id')->comment('Ид вложения.');
            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachment_files')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            $table->comment('Пивот таблица вложения постов.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_has_attachments');
    }
};
