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
        Schema::create('attachment_files', function (Blueprint $table) {
            $table->id();
            $table->text('name')->comment('Имя.');
            $table->text('original_name')->comment('Оригинальное имя файла.');
            $table->string('mime')->comment('mime тип.');
            $table->string('extension')->nullable()->comment('Разрешение.');
            $table->bigInteger('size')->default(0)->comment('Размер.');
            $table->integer('sort')->default(0)->comment('Сортировка.');
            $table->text('path')->comment('Путь.');
            $table->text('description')->nullable()->comment('Описание.');
            $table->text('alt')->nullable()->comment('Альтернативное имя.');
            $table->text('hash')->nullable()->comment('Хэш имя.');
            $table->string('disk')->default('public')->comment('Диск.');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Ид создателя.');
            $table->string('group')->nullable()->comment('Группа.');
            $table->timestamps();
            $table->comment('Вложения.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachment_files');
    }
};
