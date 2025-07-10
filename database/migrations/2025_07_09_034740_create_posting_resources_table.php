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
        Schema::create('posting_resources', function (Blueprint $table) {
            $table->id();
            $table->integer('resource_id')->nullable()->comment('Ид ресурса из микросервиса отправителя.');
            $table->string('name')->comment('Название ресурса.');
            $table->timestamps();
            $table->comment('Ресурсы для постинга');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posting_resources');
    }
};
