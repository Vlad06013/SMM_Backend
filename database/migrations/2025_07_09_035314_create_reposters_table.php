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
        Schema::create('reposters', function (Blueprint $table) {
            $table->id();
            $table->boolean('advertising_post_active')->default(false)->comment('Обработка рекламных постов.');
            $table->boolean('post_schedule_active')->default(false)->comment('Постинг по расписанию.');
            $table->boolean('make_rewrite')->default(false)->comment('Рерайт текста поста.');
            $table->boolean('add_watermark')->default(false)->comment('Добавление водяных знаков.');
            $table->boolean('auto_signature_active')->default(false)->comment('Добавление авто-подписи.');
            $table->timestamps();
            $table->comment("Репостер");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reposters');
    }
};
