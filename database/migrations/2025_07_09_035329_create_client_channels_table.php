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
        Schema::create('client_channels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posting_resources_id')->comment('Ид ресурса.');
            $table->foreign('posting_resources_id')
                ->references('id')
                ->on('posting_resources')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name')->comment('Название канала.');
            $table->mediumText('auto_signature')->comment('Текст авто-подписи.');
            $table->boolean('auto_punctuation')->default('false')->comment('Авто-пунктуация.');
            $table->unsignedBigInteger('water_marks_id')->nullable()->comment('Водяные знаки.');
            $table->foreign('water_marks_id')
                ->references('id')
                ->on('water_marks')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->unsignedBigInteger('reposter_id')->nullable()->comment('Водяные знаки.');
            $table->foreign('reposter_id')
                ->references('id')
                ->on('reposters')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->timestamps();
            $table->comment('Каналы клиента');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_channels');
    }
};
