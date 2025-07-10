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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->comment('Ид создателя.');
            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title')->nullable()->comment('Заголовок.');
            $table->mediumText('text');
            $table->string('status')->default('created')->comment('Статус. (created/confirmed/planed/sended/error/canceled)');
            $table->softDeletes();
            $table->timestamps();
            $table->comment('Посты.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
